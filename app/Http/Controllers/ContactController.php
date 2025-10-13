<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactInfo;
use App\Models\EnquiryInfo;
use Illuminate\Support\Facades\File;

class ContactController extends Controller
{
    public function addContact()
    {
        return redirect()->route('listContact', ['open' => 'add']);
    }

    public function listContact(Request $request)
    {
        $q = $request->query('q');
        $length = (int) $request->query('length', 10);
        if ($length <= 0) $length = 10;

        $contact_data = ContactInfo::when($q, function($query) use ($q) {
                $query->where('address', 'like', "%{$q}%")
                      ->orWhereJsonContains('phone', $q)
                      ->orWhereJsonContains('email', $q);
            })
            ->latest()
            ->paginate($length);

        $contact_data->appends($request->only(['q','length']));

        return view('Contact.list_contact', compact('contact_data'));
    }

    public function saveContact(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string',
            'phone' => 'nullable|array',
            'phone.*' => 'nullable|string',
            'email' => 'nullable|array',
            'email.*' => 'nullable|email',
            'address_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'phone_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'email_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $folder = public_path('ContactImage');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        // Store each image
        $address_image = $this->storeImage($request->file('address_image'), $folder);
        $phone_image   = $this->storeImage($request->file('phone_image'), $folder);
        $email_image   = $this->storeImage($request->file('email_image'), $folder);

        ContactInfo::create([
            'address' => $request->address ?? '',
            'address_image' => $address_image,
            'phone' => $request->phone ?? [],
            'phone_image' => $phone_image,
            'email' => $request->email ?? [],
            'email_image' => $email_image,
        ]);

        return redirect()->route('listContact')->with('success', 'Contact entry added successfully!');
    }

    public function editContact($id)
    {
        $row = ContactInfo::findOrFail($id);

        return response()->json([
            'id' => $row->id,
            'address' => $row->address,
            'phone' => $row->phone ?? [],
            'email' => $row->email ?? [],
            'address_image' => $row->address_image,
            'phone_image' => $row->phone_image,
            'email_image' => $row->email_image,
        ]);
    }

    public function updateContact(Request $request, $id)
    {
        $row = ContactInfo::findOrFail($id);

        $request->validate([
            'address' => 'nullable|string',
            'phone' => 'nullable|array',
            'phone.*' => 'nullable|string',
            'email' => 'nullable|array',
            'email.*' => 'nullable|email',
            'address_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'phone_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'email_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $folder = public_path('ContactImage');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        // Replace old images if new uploaded
        $address_image = $this->replaceImage($request->file('address_image'), $row->address_image, $folder);
        $phone_image   = $this->replaceImage($request->file('phone_image'), $row->phone_image, $folder);
        $email_image   = $this->replaceImage($request->file('email_image'), $row->email_image, $folder);

        $row->update([
            'address' => $request->address ?? '',
            'address_image' => $address_image,
            'phone' => $request->phone ?? [],
            'phone_image' => $phone_image,
            'email' => $request->email ?? [],
            'email_image' => $email_image,
        ]);

        return redirect()->route('listContact')->with('success', 'Contact updated successfully!');
    }

    public function deleteContact($id)
    {
        $row = ContactInfo::findOrFail($id);

        $images = [$row->address_image, $row->phone_image, $row->email_image];
        foreach ($images as $img) {
            if ($img) {
                $path = public_path('ContactImage') . DIRECTORY_SEPARATOR . $img;
                if (File::exists($path)) {
                    @unlink($path);
                }
            }
        }

        $row->delete();
        return redirect()->route('listContact')->with('success', 'Contact entry deleted.');
    }

    // Helper function to store a single image
    private function storeImage($file, $folder)
    {
        if (!$file || !$file->isValid()) return null;

        $orig = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
        $targetPath = $folder . DIRECTORY_SEPARATOR . $orig;

        if (File::exists($targetPath)) {
            $storedName = time() . '_' . uniqid() . '_' . $orig;
        } else {
            $storedName = $orig;
        }

        $file->move($folder, $storedName);
        return $storedName;
    }

    // Helper to replace old image with new one
    private function replaceImage($file, $oldName, $folder)
    {
        if ($file && $file->isValid()) {
            if ($oldName) {
                $oldPath = $folder . DIRECTORY_SEPARATOR . $oldName;
                if (File::exists($oldPath)) @unlink($oldPath);
            }
            return $this->storeImage($file, $folder);
        }
        return $oldName;
    }

    public function listEnquiry(Request $request)
    {
        $query = EnquiryInfo::query();

        // Filter by search query
        if ($request->has('q') && !empty($request->q)) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('company', 'like', "%{$q}%")
                    ->orWhere('address', 'like', "%{$q}%");
            });
        }

        $length = $request->length ?? 10;
        $enquiry_data = $query->latest()->paginate($length)->withQueryString();

        return view('Enquiry.list_enquiry', compact('enquiry_data'));
    }

}

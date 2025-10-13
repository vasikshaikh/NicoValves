<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Enquiry Received</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    </style>
</head>
<body style="font-family: 'Inter', Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin:0; padding:0; min-height: 100vh;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.15); margin: 20px;">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%); padding: 30px 20px; text-align: center; position: relative;">
                            <div style="background: rgba(255,255,255,0.1); width: 80px; height: 80px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                                {{-- <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM19 18H5C4.45 18 4 17.55 4 17V8L10.94 12.34C11.59 12.75 12.41 12.75 13.06 12.34L20 8V17C20 17.55 19.55 18 19 18ZM12 11L4 6H20L12 11Z" fill="white"/>
                                </svg> --}}
                            </div>
                            <h1 style="margin:0; font-size: 28px; font-weight: 700; color: #ffffff; letter-spacing: -0.5px;">New Enquiry Received</h1>
                            <p style="margin:10px 0 0 0; font-size: 16px; color: rgba(255,255,255,0.9); font-weight: 400;">A new contact form submission from your website</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px; color: #2c3e50;">
                            <!-- Greeting -->
                            <p style="margin:0 0 25px 0; font-size: 16px; line-height: 1.6; color: #5a6c7d;">
                                Hello Team,
                            </p>
                            <p style="margin:0 0 30px 0; font-size: 16px; line-height: 1.6; color: #5a6c7d;">
                                You've received a new enquiry through your website contact form. Here are the complete details:
                            </p>

                            <!-- Enquiry Details Card -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="background: #f8fafc; border-radius: 12px; overflow: hidden; margin: 0 0 30px 0; border: 1px solid #e2e8f0;">
                                <tr>
                                    <td style="padding: 25px;">
                                        <h2 style="margin:0 0 20px 0; font-size: 20px; font-weight: 600; color: #2c3e50; display: flex; align-items: center;">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;">
                                                <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 6C13.1 6 14 6.9 14 8C14 9.1 13.1 10 12 10C10.9 10 10 9.1 10 8C10 6.9 10.9 6 12 6ZM12 13C9.33 13 4 14.34 4 17V18C4 18.55 4.45 19 5 19H19C19.55 19 20 18.55 20 18V17C20 14.34 14.67 13 12 13ZM6 17C6.2 16.29 9.3 15 12 15C14.7 15 17.8 16.29 18 17H6Z" fill="#3498db"/>
                                            </svg>
                                            Contact Information
                                        </h2>

                                        <!-- Name & Email Row -->
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="50%" style="padding: 12px 15px; border-bottom: 1px solid #e2e8f0;">
                                                    <strong style="color: #64748b; font-size: 14px; display: block; margin-bottom: 5px;">Full Name</strong>
                                                    <span style="color: #2c3e50; font-size: 16px; font-weight: 500;">{{ $enquiry->name }}</span>
                                                </td>
                                                <td width="50%" style="padding: 12px 15px; border-bottom: 1px solid #e2e8f0; border-left: 1px solid #e2e8f0;">
                                                    <strong style="color: #64748b; font-size: 14px; display: block; margin-bottom: 5px;">Email Address</strong>
                                                    <span style="color: #3498db; font-size: 16px; font-weight: 500;">{{ $enquiry->email }}</span>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Address & Company Row -->
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="50%" style="padding: 12px 15px; border-bottom: 1px solid #e2e8f0;">
                                                    <strong style="color: #64748b; font-size: 14px; display: block; margin-bottom: 5px;">Address</strong>
                                                    <span style="color: #2c3e50; font-size: 16px;">{{ $enquiry->address ?? 'Not provided' }}</span>
                                                </td>
                                                <td width="50%" style="padding: 12px 15px; border-bottom: 1px solid #e2e8f0; border-left: 1px solid #e2e8f0;">
                                                    <strong style="color: #64748b; font-size: 14px; display: block; margin-bottom: 5px;">Company</strong>
                                                    <span style="color: #2c3e50; font-size: 16px;">{{ $enquiry->company ?? 'Not provided' }}</span>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Message -->
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding: 12px 15px;">
                                                    <strong style="color: #64748b; font-size: 14px; display: block; margin-bottom: 8px;">Message</strong>
                                                    <div style="background: white; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0; color: #2c3e50; font-size: 15px; line-height: 1.5;">
                                                        {{ $enquiry->message ?? 'No message provided' }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Action Button -->
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">
                                        <a href="mailto:{{ $enquiry->email }}" style="background: linear-gradient(135deg, #2ecc71, #27ae60); color: #ffffff; padding: 14px 32px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 16px; display: inline-block; box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3); transition: all 0.3s ease;">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle; margin-right: 8px;">
                                                <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z" fill="white"/>
                                            </svg>
                                            Reply to {{ $enquiry->name }}
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Additional Info -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 35px;">
                                <tr>
                                    <td style="background: #f1f8ff; padding: 20px; border-radius: 8px; border-left: 4px solid #3498db;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="40" style="vertical-align: top;">
                                                    <div style="background: #3498db; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM13 17H11V15H13V17ZM13 13H11V7H13V13Z" fill="white"/>
                                                        </svg>
                                                    </div>
                                                </td>
                                                <td style="padding-left: 15px;">
                                                    <p style="margin:0; font-size: 14px; color: #5a6c7d; line-height: 1.5;">
                                                        <strong>Quick Tip:</strong> Respond to this enquiry within 24 hours for better customer engagement.
                                                        This enquiry was automatically generated from your website contact form.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Footer Note -->
                            <p style="margin:30px 0 0 0; font-size: 14px; color:#94a3b8; text-align: center; padding-top: 20px; border-top: 1px solid #e2e8f0;">
                                This is an automated notification from <strong style="color: #3498db;">Website</strong>.
                                <br>Please do not reply to this email.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background: #2c3e50; padding: 20px; text-align: center; color: #cbd5e1; font-size: 13px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <p style="margin:0 0 10px 0;">
                                            &copy; {{ date('Y') }} Nico Valve. All rights reserved.
                                        </p>
                                        <p style="margin:0; font-size: 12px; color: #94a3b8;">
                                            Protecting your privacy and delivering exceptional service
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

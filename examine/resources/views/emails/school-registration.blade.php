<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Registration - Payment Instructions</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #1e293b;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #0ea5e9, #d946ef);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }

        .header p {
            margin: 10px 0 0;
            opacity: 0.95;
            font-size: 16px;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #1e293b;
        }

        .info-box {
            background: #f0f9ff;
            border: 2px solid #0ea5e9;
            border-radius: 16px;
            padding: 24px;
            margin: 24px 0;
        }

        .info-box h3 {
            margin: 0 0 16px;
            color: #0ea5e9;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .info-row {
            display: flex;
            justify-between;
            padding: 8px 0;
            border-bottom: 1px solid #e0f2fe;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #64748b;
            font-size: 14px;
        }

        .info-value {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
        }

        .payment-box {
            background: #fff7ed;
            border: 2px solid #f59e0b;
            border-radius: 16px;
            padding: 24px;
            margin: 24px 0;
        }

        .payment-box h3 {
            margin: 0 0 16px;
            color: #f59e0b;
            font-size: 18px;
        }

        .amount {
            font-size: 32px;
            font-weight: bold;
            color: #ea580c;
            text-align: center;
            margin: 16px 0;
        }

        .account-details {
            background: white;
            border-radius: 12px;
            padding: 16px;
            margin: 16px 0;
        }

        .account-details p {
            margin: 8px 0;
            font-size: 14px;
        }

        .steps {
            margin: 24px 0;
        }

        .step {
            display: flex;
            align-items: start;
            margin: 16px 0;
        }

        .step-number {
            background: #0ea5e9;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            flex-shrink: 0;
            margin-right: 12px;
        }

        .step-text {
            flex: 1;
            font-size: 15px;
            color: #475569;
            line-height: 1.6;
        }

        .important {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 16px;
            margin: 24px 0;
            border-radius: 8px;
        }

        .important p {
            margin: 0;
            color: #991b1b;
            font-size: 14px;
        }

        .footer {
            background: #f8fafc;
            padding: 30px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        .footer a {
            color: #0ea5e9;
            text-decoration: none;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            color: white;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            margin: 16px 0;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .emoji {
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="emoji">🎉</div>
            <h1>Registration Successful!</h1>
            <p>Welcome to Examine CBT Platform</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Hello <strong>{{ $admin->name }}</strong>,
            </div>

            <p>
                Thank you for registering <strong>{{ $school->name }}</strong> on the Examine CBT Platform!
                We're excited to have you join thousands of schools preparing students for academic success.
            </p>

            <!-- School Details -->
            <div class="info-box">
                <h3>📋 Your School Details</h3>
                <div class="info-row">
                    <span class="info-label">School Name:</span>
                    <span class="info-value">{{ $school->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">School Code:</span>
                    <span class="info-value" style="font-family: monospace; color: #0ea5e9;">{{ $school->code }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Student Capacity:</span>
                    <span class="info-value">{{ number_format($school->max_students) }} students</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Admin Email:</span>
                    <span class="info-value">{{ $admin->email }}</span>
                </div>
            </div>

            <!-- Payment Instructions -->
            <div class="payment-box">
                <h3>💰 Payment Instructions</h3>
                <p style="margin: 0 0 8px; font-size: 14px; color: #78350f;">Total Amount Due:</p>
                <div class="amount">₦{{ number_format($amount, 2) }}</div>
                <p style="margin: 0; font-size: 13px; color: #78350f; text-align: center;">
                    (₦1,000 × {{ number_format($school->max_students) }} students)
                </p>

                <div class="account-details">
                    <p><strong>Bank:</strong> First Bank of Nigeria</p>
                    <p><strong>Account Name:</strong> Examine CBT Limited</p>
                    <p><strong>Account Number:</strong> 1234567890</p>
                    <p><strong>Payment Reference:</strong> <span style="font-family: monospace; color: #0ea5e9;">{{ $school->code }}</span></p>
                </div>

                <div class="important">
                    <p><strong>⚠️ Important:</strong> Please use your School Code (<strong>{{ $school->code }}</strong>) as the payment reference/description to ensure quick verification.</p>
                </div>
            </div>

            <!-- Next Steps -->
            <h3 style="color: #1e293b; margin-top: 32px;">What Happens Next?</h3>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-text">
                        Make a transfer of <strong>₦{{ number_format($amount, 2) }}</strong> to the account above
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-text">
                        Use your School Code (<strong>{{ $school->code }}</strong>) as the payment reference
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-text">
                        Our team will verify your payment within <strong>24 hours</strong>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-text">
                        You'll receive an activation email with your dashboard access link
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">5</div>
                    <div class="step-text">
                        Start adding students and creating assessments! 🚀
                    </div>
                </div>
            </div>

            <!-- Support -->
            <div style="background: #f0fdf4; border: 2px solid #22c55e; border-radius: 16px; padding: 20px; margin: 24px 0; text-align: center;">
                <p style="margin: 0 0 12px; color: #166534; font-weight: 600;">Need Help?</p>
                <p style="margin: 0; font-size: 14px; color: #166534;">
                    Contact our support team at:<br>
                    <a href="mailto:support@examine.ng" style="color: #22c55e; font-weight: 600;">support@examine.ng</a><br>
                    or call <strong>+234 800 EXAMINE</strong>
                </p>
            </div>

            <p style="color: #64748b; font-size: 14px; margin-top: 24px;">
                Thank you for choosing Examine! We're committed to helping your students achieve academic excellence. 🎓
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0 0 8px;"><strong>Examine CBT Platform</strong></p>
            <p style="margin: 0;">
                <a href="{{ config('app.url') }}">www.examine.ng</a> |
                <a href="mailto:support@examine.ng">support@examine.ng</a>
            </p>
            <p style="margin: 16px 0 0; font-size: 12px; color: #94a3b8;">
                © {{ date('Y') }} Examine. All rights reserved.
            </p>
        </div>
    </div>
</body>

</html>
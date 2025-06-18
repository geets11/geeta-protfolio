<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use App\Mail\ContactFormSubmitted;
use App\Mail\ContactFormReceived;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = [
            [
                'id' => 1,
                'title' => 'Room Yatra',
                'description' => 'A comprehensive room booking and management system built with Laravel. Features include room search, booking management, payment integration, and admin dashboard.',
                'long_description' => 'Room Yatra is a complete room booking platform that revolutionizes the way people book accommodations. The system includes advanced search filters, real-time availability checking, secure payment processing, and comprehensive booking management for both users and administrators.',
                'technologies' => ['PHP', 'Laravel', 'MySQL', 'Bootstrap', 'JavaScript', 'jQuery', 'Stripe API'],
                'status' => 'Completed',
                'image' => '/images/room-yatra.jpg',
                'github' => 'https://github.com/geets11/RoomYatra',
                'demo' => 'https://roomyatra.geetakuikel.com',
                'features' => [
                    'Advanced room search and filtering',
                    'Real-time booking system',
                    'Stripe payment gateway integration',
                    'Admin dashboard for management',
                    'User reviews and ratings',
                    'Mobile responsive design',
                    'Email notifications',
                    'Booking history and management'
                ]
            ],
            [
                'id' => 2,
                'title' => 'Fashion Customizer',
                'description' => 'An innovative fashion customization platform allowing users to design and personalize clothing items with real-time preview and ordering system.',
                'long_description' => 'Fashion Customizer is a cutting-edge platform that empowers users to create personalized fashion items. Users can customize colors, patterns, sizes, and add personal touches to various clothing items with an intuitive drag-and-drop interface.',
                'technologies' => ['React', 'Node.js', 'Express', 'MongoDB', 'Canvas API', 'Stripe', 'AWS S3'],
                'status' => 'Completed',
                'image' => '/images/fashion-customizer.jpg',
                'github' => 'https://github.com/geets11/fashion-customizer',
                'demo' => 'https://fashion-customizer.geetakuikel.com',
                'features' => [
                    'Real-time design preview',
                    'Drag-and-drop customization',
                    'Color and pattern selection',
                    'Size and fit customization',
                    'Order management system',
                    'User design gallery',
                    'Social sharing features',
                    'Mobile-responsive design'
                ]
            ],
            [
                'id' => 3,
                'title' => 'Thrift Platform',
                'description' => 'A sustainable marketplace for buying and selling pre-owned items, promoting circular economy with user-friendly interface and secure transactions.',
                'long_description' => 'Thrift Platform is an eco-friendly marketplace that connects buyers and sellers of pre-owned items. The platform promotes sustainability while providing a secure and user-friendly environment for transactions.',
                'technologies' => ['Vue.js', 'Laravel', 'MySQL', 'PayPal API', 'Cloudinary', 'Socket.io'],
                'status' => 'Completed',
                'image' => '/images/thrift-platform.jpg',
                'github' => 'https://github.com/geets11/thrift-platform',
                'demo' => 'https://thrift-platform.geetakuikel.com',
                'features' => [
                    'Item listing and categorization',
                    'Advanced search and filters',
                    'Secure messaging system',
                    'PayPal payment integration',
                    'User rating and review system',
                    'Image upload and management',
                    'Real-time notifications',
                    'Seller dashboard and analytics'
                ]
            ],
            [
                'id' => 4,
                'title' => 'CR Voting System',
                'description' => 'A secure digital voting system for class representative elections with real-time results and comprehensive admin controls.',
                'long_description' => 'The CR Voting System is a complete digital solution for conducting class representative elections. It features secure authentication, real-time vote counting, result analytics, and comprehensive audit trails.',
                'technologies' => ['HTML', 'CSS', 'JavaScript', 'PHP', 'MySQL'],
                'status' => 'Completed',
                'image' => '/images/voting-system.jpg',
                'github' => 'https://github.com/geetakuikel/cr-voting-system',
                'demo' => 'https://voting.geetakuikel.com',
                'features' => [
                    'Secure voter authentication',
                    'Real-time vote counting',
                    'Result analytics and reporting',
                    'Admin panel for election management',
                    'Audit trail for transparency',
                    'Mobile-friendly interface'
                ]
            ],
            [
                'id' => 5,
                'title' => 'College Event Management',
                'description' => 'Successfully organized and managed a 400+ participant pool party event with comprehensive planning and execution.',
                'long_description' => 'Led the complete organization of a major college event, managing everything from initial planning to execution. The event included venue coordination, participant registration, entertainment planning, and safety management.',
                'technologies' => ['Project Management', 'Event Planning', 'Team Coordination', 'Budget Management'],
                'status' => 'Completed',
                'image' => '/images/event-management.jpg',
                'link' => '#',
                'features' => [
                    'Event planning and coordination',
                    'Participant registration system',
                    'Budget management and tracking',
                    'Vendor coordination',
                    'Safety and security planning',
                    'Post-event analysis and reporting'
                ]
            ],
            [
                'id' => 6,
                'title' => 'Student Management System',
                'description' => 'A comprehensive system for managing student records, grades, and academic information for educational institutions.',
                'long_description' => 'Developed as part of academic coursework, this system provides complete student lifecycle management including admission, course enrollment, grade tracking, and report generation.',
                'technologies' => ['PHP', 'MySQL', 'HTML', 'CSS', 'JavaScript'],
                'status' => 'Completed',
                'image' => '/images/student-management.jpg',
                'github' => 'https://github.com/geetakuikel/student-management',
                'features' => [
                    'Student registration and profiles',
                    'Course enrollment management',
                    'Grade tracking and reporting',
                    'Teacher dashboard',
                    'Parent portal access',
                    'Academic calendar integration'
                ]
            ]
        ];

        $skills = [
            'Programming Languages' => [
                'HTML' => 90,
                'CSS' => 85,
                'JavaScript' => 80,
                'PHP' => 85,
                'Java' => 75,
                'C' => 70
            ],
            'Frameworks & Libraries' => [
                'Laravel' => 80,
                'Bootstrap' => 85,
                'jQuery' => 75,
                'React' => 60,
                'Vue.js' => 65
            ],
            'Database & Tools' => [
                'MySQL' => 85,
                'Git & GitHub' => 80,
                'VS Code' => 90,
                'PyCharm' => 75,
                'Figma' => 70,
                'Canva' => 85
            ],
            'Soft Skills' => [
                'Project Management' => 90,
                'Public Speaking' => 85,
                'Leadership' => 88,
                'Team Management' => 85,
                'Event Management' => 92,
                'Communication' => 90
            ]
        ];

        $experiences = [
            [
                'title' => 'Computer Science Teacher',
                'company' => 'Merryland College',
                'location' => 'Biratnagar, Nepal',
                'period' => '2024 - Present',
                'type' => 'Full-time',
                'description' => 'Teaching Grade 11 Computer Science, covering fundamental programming concepts, database management, and digital literacy. Preparing lesson plans, conducting interactive learning sessions, and mentoring students in practical coding assignments.',
                'achievements' => [
                    'Improved student programming skills by 40%',
                    'Developed interactive coding curriculum',
                    'Mentored 50+ students in practical projects',
                    'Organized coding competitions and workshops'
                ]
            ],
            [
                'title' => 'Ground Level Staff',
                'company' => 'Emirates Airways',
                'location' => 'UAE',
                'period' => '2020 - 2021',
                'type' => 'Full-time',
                'description' => 'Assisted in boarding, check-in, and baggage handling processes. Delivered excellent customer service ensuring smooth travel experiences. Coordinated with internal teams to maintain operational efficiency and safety compliance.',
                'achievements' => [
                    'Maintained 98% customer satisfaction rating',
                    'Processed 200+ passengers daily efficiently',
                    'Zero safety incidents during tenure',
                    'Received customer service excellence award'
                ]
            ],
            [
                'title' => 'External Promoter',
                'company' => 'Dubai Duty Free',
                'location' => 'UAE',
                'period' => '2018 - 2020',
                'type' => 'Full-time',
                'description' => 'Promoted and sold high-end products to international travelers, providing excellent customer service. Engaged customers through interactive product demonstrations, enhancing brand awareness and sales.',
                'achievements' => [
                    'Recognized as Top Promoter for exceeding sales targets (2019)',
                    'Achieved 150% of monthly sales targets consistently',
                    'Trained 10+ new team members',
                    'Developed innovative sales strategies'
                ]
            ],
            [
                'title' => 'Sales Advisor',
                'company' => 'LALS RETAIL LLC',
                'location' => 'UAE',
                'period' => 'June 2015 - Jan 2016',
                'type' => 'Full-time',
                'description' => 'Managed sales processes, customer relations, and inventory handling. Assisted customers with product inquiries, returns, and complaints, ensuring a positive shopping experience.',
                'achievements' => [
                    'Maintained top 5 sales performance',
                    'Handled 100+ customer inquiries daily',
                    'Reduced customer complaints by 30%',
                    'Improved inventory accuracy to 99%'
                ]
            ]
        ];

        $testimonials = [
            [
                'name' => 'Bhesraj Pokhrel',
                'position' => 'Principal, Merryland College',
                'image' => '/images/bhesraj-pokhrel.jpg',
                'text' => 'Geeta is an exceptional educator who brings both technical expertise and passion to her teaching. Her students consistently show remarkable improvement in programming skills and show great enthusiasm for learning.'
            ],
            [
                'name' => 'Ahmed Al-Rashid',
                'position' => 'Supervisor, Dubai Duty Free',
                'image' => '/images/ahmed-al-rashid.jpg',
                'text' => 'One of our top performers! Geeta\'s dedication and sales expertise made her an invaluable team member. Her positive attitude was infectious and she consistently exceeded our expectations.'
            ],
            [
                'name' => 'Dr. Rajesh Sharma',
                'position' => 'Academic Director, Himalaya Darshan College',
                'image' => '/images/rajesh-sharma.jpg',
                'text' => 'Geeta has shown exceptional academic performance and leadership qualities throughout her studies. Her project work demonstrates both technical competence and innovative thinking.'
            ]
        ];

        // Static GitHub data to avoid API rate limiting
        $github_repos = $this->getStaticGitHubData();

        return view('portfolio.index', compact('projects', 'skills', 'experiences', 'testimonials', 'github_repos'));
    }

    public function contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Save to database
            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            // Send email notification to admin (uncomment when mail is configured)
            // Mail::to('kuikelgeeta6@gmail.com')->send(new ContactFormReceived($contact));

            // Send confirmation email to user (uncomment when mail is configured)
            // Mail::to($request->email)->send(new ContactFormSubmitted($contact));

            return back()->with('success', 'Thank you for your message! I will get back to you soon.');
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());
            return back()->with('error', 'Sorry, there was an error sending your message. Please try again.');
        }
    }

    public function downloadResume()
    {
        $pathToFile = public_path('files/Geeta_Kuikel_Resume.pdf');
        
        if (file_exists($pathToFile)) {
            return response()->download($pathToFile, 'Geeta_Kuikel_Neupane_Resume.pdf');
        }
        
        return back()->with('error', 'Resume file not found. Please contact me directly at kuikelgeeta6@gmail.com');
    }

    private function getStaticGitHubData()
    {
        // Static data based on actual GitHub profile: github.com/geets11
        return [
            [
                'name' => 'RoomYatra',
                'description' => 'Room Finding Software for Tenant - Complete booking and management system',
                'html_url' => 'https://github.com/geets11/RoomYatra',
                'language' => 'Blade',
                'stargazers_count' => 0,
                'forks_count' => 0,
                'updated_at' => '2024-01-15T10:30:00Z'
            ],
            [
                'name' => 'fashion-customizer',
                'description' => 'Fashion customizer software - Interactive design platform',
                'html_url' => 'https://github.com/geets11/fashion-customizer',
                'language' => 'PHP',
                'stargazers_count' => 0,
                'forks_count' => 0,
                'updated_at' => '2024-01-10T14:20:00Z'
            ],
            [
                'name' => 'thrift-platform',
                'description' => 'Thrift Fashion Platform - Sustainable marketplace for fashion items',
                'html_url' => 'https://github.com/geets11/thrift-platform',
                'language' => 'Blade',
                'stargazers_count' => 0,
                'forks_count' => 0,
                'updated_at' => '2024-01-05T09:15:00Z'
            ],
            [
                'name' => 'cr-voting-system',
                'description' => 'Digital voting system for class representative elections',
                'html_url' => 'https://github.com/geetakuikel/cr-voting-system',
                'language' => 'PHP',
                'stargazers_count' => 0,
                'forks_count' => 0,
                'updated_at' => '2023-12-20T08:45:00Z'
            ],
            [
                'name' => 'student-management',
                'description' => 'Comprehensive student management system for educational institutions',
                'html_url' => 'https://github.com/geetakuikel/student-management',
                'language' => 'PHP',
                'stargazers_count' => 0,
                'forks_count' => 0,
                'updated_at' => '2023-11-30T16:20:00Z'
            ],
            [
                'name' => 'portfolio-website',
                'description' => 'Personal portfolio website built with Laravel',
                'html_url' => 'https://github.com/geets11/portfolio-website',
                'language' => 'PHP',
                'stargazers_count' => 0,
                'forks_count' => 0,
                'updated_at' => '2024-01-20T12:15:00Z'
            ]
        ];
    }
}

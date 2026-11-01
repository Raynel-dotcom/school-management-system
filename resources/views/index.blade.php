<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Screens — Student Management System</title>

    <link rel="icon" href="assets/img/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/styles.css" />

    <style>
        /*
         * This index is the only hand-written page in the export, so it carries
         * its own styles rather than depending on utilities the Laravel build
         * happened to compile. Same tokens as the rest of the design system.
         */
        :root {
            --brand: #2563eb;
            --brand-dark: #1d4ed8;
            --brand-deep: #1e3a8a;
            --accent: #d97706;
            --canvas: #f8fafc;
            --ink: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, 'Segoe UI', sans-serif;
            -webkit-font-smoothing: antialiased;
            background: #fff;
            color: var(--ink);
        }

        .wrap { max-width: 1120px; margin: 0 auto; padding: 0 1rem; }

        /* Header */
        .top {
            position: sticky;
            top: 0;
            z-index: 10;
            border-bottom: 1px solid var(--line);
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(6px);
        }
        .top .wrap { display: flex; align-items: center; gap: .75rem; height: 4rem; }
        .top img { height: 2.25rem; width: 2.25rem; }
        .top strong { font-size: .875rem; font-weight: 600; }
        .top .count { margin-left: auto; font-size: .75rem; color: var(--muted); }

        /* Hero */
        .hero { padding: 3.5rem 0 2.5rem; }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: .3rem .75rem;
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--accent);
        }
        .hero h1 {
            margin: 1rem 0 0;
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            letter-spacing: -.02em;
        }
        .hero h1 span { color: var(--brand); }
        .hero h1 i { font-style: normal; color: var(--accent); }
        .hero p { margin: .9rem 0 0; max-width: 42rem; color: var(--muted); line-height: 1.65; }

        .legend { display: flex; flex-wrap: wrap; gap: 1.25rem; margin-top: 1.75rem; }
        .legend div { font-size: .8rem; color: var(--muted); }
        .legend b { display: block; font-size: 1.5rem; font-weight: 800; color: var(--ink); }

        /* Sections */
        /* `.wrap` also sets padding, so match its specificity here. */
        section.wrap { padding: 2.5rem 1rem; }
        section.wrap + section.wrap { border-top: 1px solid var(--line); }
        .label {
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
        }
        .label em { font-style: normal; color: var(--accent); }
        h2 { margin: .4rem 0 1.25rem; font-size: 1.125rem; font-weight: 700; }

        .grid {
            display: grid;
            gap: .875rem;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        }

        .card {
            display: block;
            border: 1px solid var(--line);
            border-left: 3px solid transparent;
            border-radius: .75rem;
            background: #fff;
            padding: 1rem 1.1rem;
            text-decoration: none;
            color: inherit;
            transition: border-color .15s, box-shadow .15s, transform .15s;
        }
        .card:hover {
            border-color: var(--brand);
            border-left-color: var(--brand);
            box-shadow: 0 8px 24px -12px rgba(37, 99, 235, .35);
            transform: translateY(-1px);
        }
        .card b { display: block; font-size: .9rem; font-weight: 600; }
        .card span { display: block; margin-top: .3rem; font-size: .8rem; color: var(--muted); line-height: 1.5; }
        .card code {
            display: block;
            margin-top: .55rem;
            font-size: .7rem;
            color: var(--brand);
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
        }

        /* Sign-in shortcuts */
        .shortcuts {
            display: flex;
            flex-wrap: wrap;
            gap: .6rem;
            margin-top: 1.75rem;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            border-radius: .75rem;
            padding: .6rem 1.1rem;
            font-size: .875rem;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid var(--line);
            color: var(--ink);
            background: #fff;
        }
        .btn.primary { background: var(--brand); border-color: var(--brand); color: #fff; }
        .btn.primary:hover { background: var(--brand-dark); border-color: var(--brand-dark); }
        .btn:hover { border-color: var(--brand); color: var(--brand); }
        .btn.primary:hover { color: #fff; }

        /* Note */
        .note {
            margin: 1rem 0 2.5rem;
            border: 1px solid var(--line);
            border-left: 3px solid var(--accent);
            border-radius: .75rem;
            background: var(--canvas);
            padding: 1rem 1.1rem;
            font-size: .825rem;
            color: var(--muted);
            line-height: 1.6;
        }
        .note b { color: var(--ink); }

        /* Footer */
        footer { background: var(--brand-deep); margin-top: 1rem; }
        footer .wrap {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            justify-content: space-between;
            padding: 1.1rem 1rem;
            font-size: .875rem;
            color: #dbeafe;
        }
        footer b { color: #fff; }
    </style>
</head>
<body>

<!-- Start: Header -->
<div class="top">
    <div class="wrap">
        <img src="assets/img/mubs-crest-192.png" alt="Makerere University Business School crest">
        <strong>Student Management System</strong>
        <span class="count">27 screens &middot; static HTML</span>
    </div>
</div>
<!-- End: Header -->

<!-- Start: Hero -->
<div class="wrap hero">
    <span class="eyebrow">Makerere University Business School</span>
    <h1>Front-end screens, <span>exported as plain <i>HTML</i></span></h1>
    <p>
        Every page of the Laravel Student Management System, rendered against the
        seeded database and saved as a standalone HTML file. No PHP, no build
        step, no database — open a file and the screen is there, with the real
        students, courses and registrations baked in.
    </p>

    <div class="legend">
        <div><b>27</b> screens</div>
        <div><b>3</b> roles</div>
        <div><b>1</b> stylesheet</div>
        <div><b>0</b> dependencies</div>
    </div>

    <div class="shortcuts">
        <a class="btn primary" href="login.html">Start at the sign-in page</a>
        <a class="btn" href="admin/dashboard.html">Administrator</a>
        <a class="btn" href="staff/dashboard.html">Lecturer</a>
        <a class="btn" href="dashboard.html">Student</a>
    </div>
</div>
<!-- End: Hero -->

<!-- Start: Public screens -->
<section class="wrap">
    <p class="label">Public &mdash; <em>no sign-in</em></p>
    <h2>Authentication</h2>

    <div class="grid">
        <a class="card" href="login.html">
            <b>Sign in</b>
            <span>Crest, campus email and password with leading icons, keep-me-signed-in.</span>
            <code>/login</code>
        </a>
        <a class="card" href="register.html">
            <b>Create an account</b>
            <span>Student self-registration — name, email, programme, year of study.</span>
            <code>/register</code>
        </a>
        <a class="card" href="forgot-password.html">
            <b>Forgot password</b>
            <span>Request a reset link by email.</span>
            <code>/forgot-password</code>
        </a>
        <a class="card" href="reset-password.html">
            <b>Reset password</b>
            <span>Set a new password from a reset link.</span>
            <code>/reset-password/{token}</code>
        </a>
    </div>
</section>
<!-- End: Public screens -->

<!-- Start: Student screens -->
<section class="wrap">
    <p class="label">Student &mdash; <em>Brian Mukasa</em></p>
    <h2>Registering for courses</h2>

    <div class="grid">
        <a class="card" href="dashboard.html">
            <b>Dashboard</b>
            <span>How many courses are open, how many this student has taken.</span>
            <code>/dashboard</code>
        </a>
        <a class="card" href="courses.html">
            <b>Course catalogue</b>
            <span>Every course on offer, read-only — no edit or delete controls.</span>
            <code>/courses</code>
        </a>
        <a class="card" href="course.html">
            <b>One course</b>
            <span>Code, title, credit units and the lecturer assigned to it.</span>
            <code>/courses/{id}</code>
        </a>
        <a class="card" href="my-courses.html">
            <b>My registrations</b>
            <span>Courses already taken, courses still available, and the register form.</span>
            <code>/my/courses</code>
        </a>
        <a class="card" href="profile.html">
            <b>My account</b>
            <span>Profile details, password change, delete account dialog.</span>
            <code>/profile</code>
        </a>
    </div>
</section>
<!-- End: Student screens -->

<!-- Start: Lecturer screens -->
<section class="wrap">
    <p class="label">Lecturer &mdash; <em>Dr. Sarah Nakato</em></p>
    <h2>Teaching</h2>

    <div class="grid">
        <a class="card" href="staff/dashboard.html">
            <b>Dashboard</b>
            <span>Courses assigned to this lecturer and the students on them.</span>
            <code>/dashboard</code>
        </a>
        <a class="card" href="staff/teaching.html">
            <b>My courses</b>
            <span>The two courses this lecturer teaches, with student counts.</span>
            <code>/teaching</code>
        </a>
        <a class="card" href="staff/teaching-course.html">
            <b>Students on a course</b>
            <span>The class list for one assigned course.</span>
            <code>/teaching/{id}</code>
        </a>
        <a class="card" href="staff/courses.html">
            <b>Course catalogue</b>
            <span>The same read-only listing a student sees.</span>
            <code>/courses</code>
        </a>
        <a class="card" href="staff/course.html">
            <b>One course</b>
            <span>Course detail — note the sidebar has no Students or Registrations.</span>
            <code>/courses/{id}</code>
        </a>
        <a class="card" href="staff/profile.html">
            <b>My account</b>
            <span>Profile details and password change.</span>
            <code>/profile</code>
        </a>
    </div>
</section>
<!-- End: Lecturer screens -->

<!-- Start: Administrator screens -->
<section class="wrap">
    <p class="label">Administrator &mdash; <em>full access</em></p>
    <h2>Managing the system</h2>

    <div class="grid">
        <a class="card" href="admin/dashboard.html">
            <b>Dashboard</b>
            <span>Students, courses, lecturers and registrations across the whole system.</span>
            <code>/dashboard</code>
        </a>
        <a class="card" href="admin/students/index.html">
            <b>Students</b>
            <span>All five seeded students with generated student numbers.</span>
            <code>/students</code>
        </a>
        <a class="card" href="admin/students/create.html">
            <b>Add a student</b>
            <span>Creates the login account and the student record together.</span>
            <code>/students/create</code>
        </a>
        <a class="card" href="admin/students/show.html">
            <b>Student detail</b>
            <span>One student's profile and the courses they are registered for.</span>
            <code>/students/{id}</code>
        </a>
        <a class="card" href="admin/students/edit.html">
            <b>Edit a student</b>
            <span>Same form, pre-filled; the password field is optional here.</span>
            <code>/students/{id}/edit</code>
        </a>
        <a class="card" href="admin/courses/index.html">
            <b>Courses</b>
            <span>Four courses with their lecturers — unassigned reads <i>Unassigned</i>.</span>
            <code>/courses</code>
        </a>
        <a class="card" href="admin/courses/create.html">
            <b>Add a course</b>
            <span>Code, title, credit units, and a lecturer picked from the Lecturer role.</span>
            <code>/courses/create</code>
        </a>
        <a class="card" href="admin/courses/show.html">
            <b>Course detail</b>
            <span>One course and the students registered for it.</span>
            <code>/courses/{id}</code>
        </a>
        <a class="card" href="admin/courses/edit.html">
            <b>Edit a course</b>
            <span>Reassign the lecturer or correct the course details.</span>
            <code>/courses/{id}/edit</code>
        </a>
        <a class="card" href="admin/registrations/index.html">
            <b>Registrations</b>
            <span>Every student-course pair in the system, with cancel buttons.</span>
            <code>/registrations</code>
        </a>
        <a class="card" href="admin/registrations/create.html">
            <b>Register a student</b>
            <span>Pick a student and a course — duplicates are rejected.</span>
            <code>/registrations/create</code>
        </a>
        <a class="card" href="admin/profile.html">
            <b>My account</b>
            <span>Profile details and password change.</span>
            <code>/profile</code>
        </a>
    </div>
</section>
<!-- End: Administrator screens -->

<!-- Start: Note -->
<div class="wrap">
    <p class="note">
        <b>These screens are a copy, not the application.</b>
        Links between pages work, the phone sidebar opens and the delete-account
        dialog still pops up, but nothing is saved: every form shows the screen
        it would land on instead of posting. The live system is the Laravel
        project at <code>C:\xampp\htdocs\school-proj</code>.
    </p>
</div>
<!-- End: Note -->

<!-- Start: Footer -->
<footer>
    <div class="wrap">
        <p>&copy; 2026 <b>Makerere University Business School</b></p>
        <p>Students &middot; Courses &middot; Lecturers &middot; Registrations</p>
    </div>
</footer>
<!-- End: Footer -->

</body>
</html>

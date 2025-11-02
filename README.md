E-Voting System (AngularJS + PHP)

This project is a simple Electronic Voting (E-Voting) System developed using AngularJS (frontend) and PHP with MySQL (backend).
It allows voters to register, log in securely, vote for their preferred candidate.
Admins can manage candidates and view the election results in a clear, tabular format.

Voter Side

Voter Registration – Voters can sign up with name, email, username, password, and phone number.

Login System – Secure login validation using PHP and AngularJS.

Voting Interface – After logging in, voters can view candidates and vote for one candidate only.

Vote Restriction – A voter cannot vote more than once.

Thank You Message – After successful voting, a message is displayed confirming submission.

Admin Side

Admin Login – Admins can log in securely (using PHP sessions).

Add New Candidate – Admin can add candidates with name, party, and description.

View All Candidates – Admin can view and manage all candidates.

View Results – Election results displayed in descending order with a highlighted top candidate.

Menu Navigation – Simple admin dashboard with menu options (Add Candidate, View Results, Logout).

Tech Stack
| Layer    | Technology Used        |
| -------- | ---------------------- |
| Frontend | AngularJS, HTML, CSS   |
| Backend  | PHP                    |
| Database | MySQL                  |
| Server   | XAMPP (Apache + MySQL) |

Folder Structure 

evote-app/
│
├── api/
│   ├── db_connect.php
│   ├── register.php
│   ├── login.php
│   ├── vote.php
│   ├── add_candidate.php
│   ├── get_candidates.php
│   └── get_results.php
│
├── includes/
│   ├── header.html
│   └── footer.html
│
├── css/
│   └── style.css
│
├── js/
│   └── app.js
│
├── admin-login.html
├── admin-home.php
├── admin-results.php
├── register.html
├── login.html
├── vote.html
├── index.html
└── README.md

Database Structure
Table: Voters
| Column   | Type         | Description     |
| -------- | ------------ | --------------- |
| id       | INT (PK)     | Auto increment  |
| name     | VARCHAR(100) | Voter name      |
| email    | VARCHAR(100) | Unique email    |
| username | VARCHAR(100) | Unique username |
| password | VARCHAR(255) | Hashed password |
| phone    | VARCHAR(20)  | Phone number    |

Table : candidates

| Column | Type         | Description    |
| ------ | ------------ | -------------- |
| id     | INT (PK)     | Auto increment |
| name   | VARCHAR(100) | Candidate name |
| party  | VARCHAR(100) | Party name     |
| votes  | INT          | Total votes    |

Table: Votes

| Column         | Type         | Description       |
| -------------- | ------------ | ----------------- |
| id             | INT (PK)     | Auto increment    |
| voter_username | VARCHAR(100) | Username of voter |
| candidate_id   | INT          | Candidate ID      |

GitHub: github.com/seethal16# evote-app

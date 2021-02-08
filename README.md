# CtrlBudget
This is a budget managing web application. 

								CONTROL BUDGET
Pages:
1.	Index Page
2.	Login page
3.	Sign up page 
4.	Home page
5.	Create a new plan page
6.	Plan detail page
7.	View plan page + Add new expense Form
8.	Expense distribution page
9.	Logout page
10.	Change Password 
11.	About us page

Tables in database:

1.	Users table
2.	Budget index table
3.	Budget member table
4.	Member expenditure table


INTRODUCTION-

All the pages consists of three major parts: header, content and footer.  The header of each page depends on the status of the session, i.e., if the session is set then it will contain links to the following pages: About Us, Change Password and Logout pages, whereas if the session is not set then it will contain the links to: About Us, Sign Up and Login pages.
The logo is the link to the index page (if session is not set) and to the home page (if session is set).
	
The content part for each page depends on the requirement. 

The footer part is same for all the pages.

1.INDEX PAGE (index.php)-
This is the first page. It consist of the Start Today button which will redirect to the login.php page.

2.LOGIN PAGE (login.php)-
This page consists of form for login. If the user is new then there is a link to redirect him/her to the sign up page.
The backend code is present in login_submit.php file. After login the user is redirected to home page. This page verifies data from users table.

3.SIGN UP (signup.php)-
This page consists of form for signup. After singing up the user is redirected to home page. The backend code is present in signup_script.php file. This form stores data in users table.

4.HOME (home.php)-
This page has two phases:
i)No plans:
	In this case, it will only display a link to create a new plan page.
ii)With plans:
	In this case, it will display all the plans of the user along with a link to create a new plan page. Each plan will contain a button View Plan which will redirect the user to View Plan page.


5.CREATE A NEW PLAN (create-a-new-plan.php)-
This page consist a form to enter the initial budget and number of people involved in the plan. The data is stored in budget_index table.The backend code is wriitn in new-plan.php file. The submit button redirects to Plan details page.

6.PLAN DETAILS (plan-details.php)-
This page asks the user to enter more details about the plan. The data is stored in budget_index table and budget_member table. The backend code is present in plan-script.php file. After entering the data the user is redirected to home page.

7.VIEW PLAN (view-plan.php)-
This page is divided into four parts.
i)	The first part consist of a panel showing plan details like: initial budget, remaining amount, duration, title and number of members. The remaining amount is updated every time payment is made.
ii)	The second part consist of a form to add new expenses. This form takes detail of the expense made like: title, amount, paid by, date and bill image (if any). The data is stored in member_expenditure table. The backend code is present in view-script.php file.
iii)	The third part displays detail for every expenditure. The data is obtained from member_expenditure table. Every time an expenditure is done, a new panel is added for that expense.
iv)	The last part consist of expense distribution button which will redirect to Expense Distribution page.

8.EXPENSE DISTRIBUTION (expense-distribution.php)-
This page shows detail of the expenses made like: initial budget, remaining amount, total expenses, individual expense and individual share. It also consist of a button to go back to View Plan page. It fetches data from budget_member and member_expenditure tables.

9.ABOUT US (aboutus.php)-
It consist of introduction and information of Control Budget.

10.CHANGE PASSWORD (change-password.php)-
The user can change his/her password in this page. The backend code is present in password-script.php file. The data is stored to and verified from users table.

11.LOGOUT (logout.php)-
This php file contains the code to end/destroy the session.

  

# EduFlow
Eduflow is a modern school management platform built with PHP and Laravel, designed to streamline administrative tasks and enhance communication between students, teachers, and parents. It offers user-friendly features like attendance tracking, grade management, and scheduling, all within a secure and scalable framework.

  

## Team members
<table>
	 <thead> 
		 <tr> 
			 <th>ID</th> 
			 <th>Name</th> 
			 <th>Email</th> 
			 <th>Github Name</th>
			 <th>Role</th> 
		 </tr> 
	 </thead> 
	 <tbody> 
		 <tr> 
			 <td>20220104071</td> 
			 <td>Zarif Mahmud</td> 
			 <td>zarifmahmud250@gmail.com</td> 
			 <td>Zarif50</td>
			 <td>Lead (Frontend+Backend)</td> 
		 </tr> 
		 <tr> 
			 <td>20220104060</td> 
			 <td>Md.Tanzil Tanim</td> 
			 <td>tanimtanzilislam9@gmail.com</td>
			 <td>animtanzilislam</td>
			 <td> frontend+Backend</td>   
		 </tr> 
		 <tr> 
			 <td>20220104063</td> 
			 <td>Sanaf Salehin</td> 
			 <td>sanafsalehin@gmail.com</td>
			  <td>sanafsalehin</td> 
			 <td>Backend</td>   
		 </tr> 
		 <tr> 
			 <td>202201069</td> 
			 <td>Afia Adilah</td> 
			 <td>afiadilah246@gmail.com</td>
			  <td>afiadilah246</td> 
			 <td>Frontend</td>   
		 </tr> 
	 </tbody> 
 </table>

  

## Target Audience

  

1)School Administrators: Looking for efficient tools to manage student records, staff information, and overall school operations.

2)Teachers: In need of a platform to track attendance, manage grades, share assignments, and communicate with parents.

3)Parents: Interested in staying informed about their child's academic performance, attendance, and school activities.

4)Students: Seeking an organized system to access schedules, assignments, and performance reports conveniently.

5)Educational Institutions: Schools, colleges, and tutoring centers aiming to digitalize and optimize their management processes.






  
  

## Tech Stack
<table>
	 <thead> 
		 <tr> 
			 <th>Teck Stack</th> 
			 <th>We Use</th> 
		 </tr> 
	 </thead> 
	 <tbody> 
		 <tr> 
			 <td>Backend</td> 
			 <td>Laravel</td> 
		 </tr> 
		 <tr> 
			 <td>Frontend</td> 
			 <td>php</td>   
		 </tr> 
		 <tr> 
			 <td>Database</td> 
			 <td>phpMyAdmin</td>  
		 </tr>  
		 <tr> 
			 <td>Rendering Method</td> 
			 <td>CSR (Client-Side Rendering)</td> 
		 </tr> 
		  <tr> 
			 <td>Version Control</td> 
			 <td>Git</td> 
		 </tr> 
		  <tr> 
			 <td>Repository</td> 
			 <td>Github</td> 
		 </tr> 
	 </tbody> 
 </table>
  
## UI Design
Figma Design   :<a href="https://www.figma.com/design/698MIXaZPQRPmjMFVvdZzh/Untitled?m=auto&t=yKu9x5ELny2uWqwU-6">Figma Design</a>


## Project Features

### User Section
<ul>
	<li>Implement secure login and registration for multiple user roles such as Admin, Teachers, Students, and Parents.</li>
	<li>Ensure role-based access control to protect sensitive information and functionalities.</li>
	<li>Allow users to Create, Read, Update, and Delete data related to their respective roles (e.g., student profiles, teacher records, assignments, schedules).</li>
  <li>Maintain data validation and error handling for seamless user experience.</li>
  <li>Provide dynamic search functionality for records like students, classes, assignments, and attendance.</li>
</ul>



### Admin Section
<ul>
	<li>Multi Admin Authentication</li>
	<li>Forget Password</li>
	<li>Admin Panel</li>
</ul>

### Teacher Section
<ul>
	<li>Multi Admin Authentication</li>
	<li>Forget Password</li>
	<li>Teacher Panel</li>
</ul>

### Student Section
<ul>
	<li>Multi Student Authentication</li>
	<li>Forget Password</li>
	<li>Teacher Panel</li>
</ul>

### Parent Section
<ul>
	<li>Multi Parent Authentication</li>
	<li>Forget Password</li>
	<li>Parent Panel</li>
</ul>

##  API Endpoints
### **Authentication**



- **POST** `/api/users/register` - User registration for Admin, Teacher, Student, or Parent roles.
- **POST** `/api/users/login` - User login based on assigned roles.
- **POST** `/api/users/logout` - User logout to end active sessions securely.
- **POST** `/api/users/forgot-password` - Forgot password functionality with email recovery for any user role.
- **POST** `/api/users/reset-password` - Reset password using a token sent to the registered email.



#### Admin Authentication

- **POST** `/api/admin/login` - Admin login.
- **POST** `/api/admin/logout` - Admin logout.

----------
### Teacher Authentication
- **POST** `/api/teachers/register`- Teacher registration.
- **POST** `/api/teachers/login` - Teacher login.
- **POST** `/api/teachers/logout` - Teacher logout.

### Student Authentication
- **POST** `/api/students/register`- Student registration.
- **POST** `/api/students/login` - Student login.
- **POST** `/api/students/logout` - Student logout.

  ### Parent Authentication
- **POST** `/api/parents/register`- Parent registration.
- **POST** `/api/parents/login` - Parent login.
- **POST** `/api/parents/logout` - Parent logout.
----------


----------



----------


## Milestones
<table>
	 <thead> 
		 <tr> 
			 <th>Milestones</th> 
			 <th>We Cover</th> 
		 </tr> 
	 </thead> 
	 <tbody> 
		 <tr> 
			 <td>Checkpoint 1</td> 
			 <td>
				 <ul>
					 <li>Frontend, Backend, Database setup</li>
					<li>registration and login pages</li>
					<li>authentication</li>
					<li>Table for Teacher, student and parent at Database</li>
				</ul>
			</td>
		 </tr> 
		 <tr> 
			 <td>Checkpoint 2</td> 
			 <td>
				 <ul>
					 <li>Introduce Packages in Home Page</li>
					 <li>Search and filtering option for teacher, student and parents</li>
					 <li>Form validation and unique email address</li>
					 <li>Class handling,Assigning subject into them</li>
					  <li>Changing password of profile</li>
					  <li>Parent section</li>
					  <li>Teacher Section</li>
					  <li>Academic Menu ,submenu</li>
					  <li>Class timetable</li>
				 </ul>
			 </td>   
		 </tr> 
		 <tr> 
			 <td>Checkpoint 3</td> 
			 <td><ul>          
				          
					  <li>Exam Schedule</li>
                                           <li>Exam Marks Register</li>
					    <li>Exam Result</li>
	                                    <li>Student Attendence</li>
				         <li>Admin Authentication</li>
					 <li>Admin Profile</li>
					 <li>Approve or Reject  and handle users by Admin</li>			
				 </ul>
				</td>  
		 </tr> 
	 </tbody> 
 </table>


 

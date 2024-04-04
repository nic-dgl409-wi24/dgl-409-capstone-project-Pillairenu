# Project Overview
**Project Name-RideConnect**

RideConnect represents a transformative approach to local travel, offering a community-driven platform specifically designed to tackle transportation challenges within the Comox Valley, Courtenay, and Campbell River regions. It is an innovative ride-sharing app that reimagines the concept of community-based travel. Unlike traditional ride-sharing services, RideConnect is designed around a peer-to-peer model that allows regular community members to share their extra seats with others who are heading in the same direction. This project is not just about getting from point A to point B but about fostering connections, building community, and promoting sustainable travel habits. This revolutionary app serves as a comprehensive solution, nurturing local connectivity by delivering an alternative transportation option that is not only cost-effective and reliable but also champions environmental sustainability. RideConnect is built with user-centric features, an efficient admin panel, and a strong emphasis on security, ensuring a seamless and safe user experience. The platform's mission extends beyond fulfilling immediate transportation needs; it is committed to fostering a more interconnected, innovative, and environmentally conscious local transportation ecosystem. The target audience includes local residents and commuters seeking reliable and flexible transportation solutions.


## RideConnect Project Setup
### Overview
This guide outlines the necessary steps to clone, set up, and run the RideConnect project on your local machine. The project utilizes a Model-View-Controller (MVC) architecture, requiring specific setup steps to ensure everything functions as expected.

### Prerequisites
Before you begin, ensure you have the following installed on your computer:

Git
Visual Studio Code (VSCode) or any preferred IDE
XAMPP (for Windows) or MAMP (for macOS)
Github Desktop

## Getting Started

1. Access the GitHub Repository
Ensure you have access to the GitHub repository. If not, request access from the project maintainer.

2. Clone the Repository
Open a terminal or command prompt and run the following command to clone the repository to your local machine.

3. Install and Configure XAMPP
   Download and install XAMPP from Apache Friends.
   Start the Apache and MySQL modules from the XAMPP control panel.
   
4. Set Up the Database

  Launch PHPMyAdmin from the XAMPP control panel.
  Create a new database named rideconnect.
  Create a new user with appropriate permissions for rideconnect, and remember the username and password.
  Import the provided SQL file in the Database folder in repository to set up the database schema and initial data.

5. Configure the Project to Use the Database
   Update the project's database configuration file with the database name (rideconnect), user, and password you created in the previous step.

6. Running the Project with XAMPP

    Starting Apache and MySQL Services
      1. Launch XAMPP Control Panel: Open the XAMPP Control Panel application on your computer.
      2. Start Apache and MySQL Services: Locate the Apache and MySQL modules within the XAMPP Control Panel. Click the Start button next to each module to run them. These services are essential for your PHP       application and MySQL database to function.
   Accessing the Shell from XAMPP
      1. Open Shell: In the XAMPP Control Panel, next to the Start button for Apache, there might be a Shell button (the availability can vary based on your XAMPP version and operating system). Click on Shell to open a command-line interface. If your XAMPP does not have a Shell option, you can use the regular command prompt or terminal on your system.
    Navigating to Your Project Directory
      1. Navigate to the htdocs Directory: Your project should be located within the htdocs directory of your XAMPP installation. Use the command line to navigate there. Assuming XAMPP is installed in the root directory, you can use:
      `` bash
      cd /path/to/xampp/htdocs/dgl-409-capstone-project-Pillairenu
      ``
      Replace /path/to/xampp with the actual path to your XAMPP installation.
    Starting the PHP Server
      Run the PHP Built-in Server: While in your project's directory, start the PHP built-in server by specifying a port number. For example, to use port 8000, you would run:
      `` bash
      php -S localhost:8000
      ``
      This command starts a PHP server on your local machine accessible via localhost on port 8000.
    Accessing the Application
      1. Open Your Web Browser: Launch your preferred web browser.
      2. Enter the Localhost Address: In the browser's address bar, type http://localhost:8000 and press Enter. This directs you to the running instance of the RideConnect application hosted by the PHP built-in server.
    Note on XAMPP and PHP Server
      Using XAMPP's Apache Server: If you're running the application through XAMPP's Apache server, ensure your .htaccess file and Apache configuration are correctly set to handle URL rewrites and direct traffic to your application.
      Direct PHP Server Use: The direct use of php -S localhost:8000 for testing simplifies the process but bypasses Apache. This method is excellent for quick testing but might not fully replicate the environment provided by XAMPP's Apache server.

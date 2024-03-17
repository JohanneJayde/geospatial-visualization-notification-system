# Geospatial Visualization Notification System
### By Randy Pipkins, Mikayla Stewart, Johanne McClenahan, and Ian Goss


### Running the Application
1. `Node.js`, `PHP`, and `NPM` need to be installed on the local machine
2. The following npm packages must be installed: `ol`, `proj4`, `webpack`
3. `Laragon` must be installed
4. After all have been installed, from the root for the repository, run `npm run build`, this should create a webpack that will be used when launching the site.
5. From the Laragon program, click "Run All" and it should deploy the production site.
6. Click `Web` to view the website from `localhost`

# Info regarding the Server and Database

## Server
- Server is running on MySql 8.0.30
- Hosted through [Laragon](https://laragon.org/index.html)

## Database
- Code written for communication with database in PHP 5.6 with CLI Interpreter 8.1.10
- Managed and visualized through [PhpMyAdmin](https://www.phpmyadmin.net/)

The following are the login parameters you need to set when you open the Laragon MySQL GUI:

```
$username = "root";
$password = "CSCD488_490GroupProject";
```

## [Potential Improvements](https://docs.google.com/document/d/1l9tspndiGUt_pofIWAVSMquhdhagv7UsUj_Y2uNl_UA/edit?usp=sharing)

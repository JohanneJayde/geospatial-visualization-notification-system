# Geospatial Visualization Notification System
### By Randy Pipkins, Mikayla Stewart, Johanne McClenahan, and Ian Goss

### Developing the site
1. Clone repo
2. `Node.js`, `PHP`, `npm` need to be installed
3. npm packages: `ol`, `proj4`, `webpack`
4. Software: `Laragon`
5. For Laragon, update default path to cloned repo root directory
6. Everytime you make a change to `dashboard.js`, you must do `npm run build`. This updates the `map.js` which is a webpack so it can be run via localhost
7. Click `Run all` on Laragon and it should deploy development site on localhost
8. Monitoring the SQL server requires opening up Laragon MySQL and entering the root password found at the end

### Running the Application
1. `Laragon` must be installed
2. After all have been installed, from the root for the repository, run `npm run build`, this should create a webpack that will be used when launching the site.
3. Make sure to change laragon's www root to the root of the repo.
4. From the Laragon program, click "Run All" and it should deploy the development site.
5.  Click `Web` to view the website from `localhost`.

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

<h1>Fluttr</h1>
A small microblogging website written in CodeIgniter.

<h2>Licence</h2>
Please note that <a href="https://raw.githubusercontent.com/WillRiches/Fluttr/master/LICENSE">this work is licenced</a> under Apache License 2.0.

<h2>Requirements</h2>
<ul>
<li>PHP 5.4+</li>
<li>MySQL 5.1+</li>
<li>Designed for Apache2 (no rewrites are given for nginx etc)</li>
</ul>

<h2>Installation instructions</h2>
<ol>
<li>Download the latest version of CodeIgniter 3</li>
<li>Upload CodeIgniter + /application + /assets + /.htaccess  to the web server</li>
<li>Execute the <a href="https://raw.githubusercontent.com/WillRiches/Fluttr/master/fluttr_db_structure.sql">DB create script</a> on the SQL server</li>
<li>Edit the config in application/config/config.php, changing $config['base_url'] to the URL of your public Fluttr root (with trailing slash)</li>
<li>Edit the database config in application/config/database.php, changing the database credentials to match those of your SQL database.</li>
</ol>

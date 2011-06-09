
copyright:  2010, University of Geneva
author:     laurent.opprecht@unige.ch
license:    GNU

This plugin adds Shibboleth as an authentication mecanism to LimeSurvey.

HOW IT WORKS

Authentication is not actually provided by this plugin but by the web server using the Shibboleth's security module.
When a user want to access a secured resource - login_page.php for this plugin - he is first redirected by the web server to the login page of the identity provider.
Once the user has been authenticated by the identity provider he is granted access and redirected to the secured resource - login_page.php.
User information are then available in $_SERVER.
As a result the login page do not provide a user interface because it is reached only once the user has been authorized.

On first login the user profile is created in the database using shibboleth's attributes and defaults values.
Those values can then be changed if required. For example to customize rights.
Upon successive login, the user profile is not overwritten by shibboleth's attributes. In this case the user is loged-in with his database profile.

LimeSurvey do not really provide a plugin mecanism for authentication. 
Still this module follows a plugin approach and strives to factor as much code as possible out of LimeSurvey.

REQUIRED

You need to install the Shibboleth security module for your web server first.
See http://shibboleth.internet2.edu/ for additional information on how to install shibboleth.

PLUGIN INSTALLATION

1. Unzip files in your LimeSurvey directory. Ensure that the Shibboleth directory appears under

    limesurvey/admin/auth/shibboleth

2. (optional) You must secure login_page.php access with the shibboleth security module. 
   The .htaccess file does it for you. If you don't use it you must configure your web server manually.
   For Apache you can add the following directive in httpd.conf.

        <Location /limesurvey/admin/auth/shibboleth/login_page.php>
          AuthType shibboleth
          ShibRequestSetting requireSession 1
          require valid-user
        </Location>

   You can further customize security rules if required.
   For further examples see

        /opt/shibboleth-sp/etc/shibboleth/dist
        http://shibboleth.internet2.edu/
        http://www.switch.ch/aai/support/serviceproviders/sp-access-rules.html

3. Patch LimeSurvey. Navigate your browser to:

    limesurvey/admin/auth/shibboleth/patch/patch.php

   Or manually change admin/admin.php. See patch/patch.class.php for details.  

4. (optional) If you don't use the Switch AAI config you must customize config.php.

   First map your Shibboleth's attributes to the constant used by the plugins

        $shibboleth_config[shibboleth::FIRSTNAME] = 'the name of the shibboleth attribute storing the user first name';
        ..

   Second add the text of the link that will appears after the login form.

        $shibboleth_config[shibboleth::LINK_TEXT] = 'My provider name';

   Modify the link image that is display after the login form.

5. (optional) If required you can further customize the html markup that will appear after the login page by modifying

        login_link.php.

6. (optional) If you need to customize the business logic. For example to define rights based on Shibboleth's attributes.
   For this you can modify

        PluginShibboleth::get_shibboleth_user()

   In

        plugin.php


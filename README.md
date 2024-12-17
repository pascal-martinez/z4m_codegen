# ZnetDK 4 Mobile module: Code Generator (z4m_codegen)
![Screenshot of the CRUD Code Generator view provided by the ZnetDK 4 Mobile 'z4m_codegen' module](https://mobile.znetdk.fr/applications/default/public/images/modules/z4m_codegen/screenshot1.png?v1.0)

The **z4m_codegen** module allows to generate CRUD code for managing your custom data in your [ZnetDK 4 Mobile](/../../../znetdk4mobile) Starter Application.

See demonstation at [Code Generator page](https://mobile.znetdk.fr/crud_code_generator).

## LICENCE
This module is published under the version 3 of GPL General Public Licence.

## USAGE
In the code generator form, enter an entity name, for example *Book* if you want to manage a file of books.

Next, enter the properties of the entity. For a book, they could be a *title*, a *publication date*, a *summary*, the *number of pages* and so forth.

Finally, choose an icon to display for the generated view, the prefix to use for HTML element identifiers, the App controller name,
the SQL table name, the location of the generated code (*module* or *application*) and the *DAO class* to use, then click the **Get the code** button.

## REQUIREMENTS
- [ZnetDK 4 Mobile](/../../../znetdk4mobile) version 3.4 or higher,
- A **MySQL** database [is configured](https://mobile.znetdk.fr/getting-started#z4m-gs-connect-config) to store the application data,
- **PHP version 7.4** or higher,

## INSTALLATION
1. Add a new subdirectory named `z4m_codegen` within the
[`./engine/modules/`](/../../../znetdk4mobile/tree/master/engine/modules/) subdirectory of your
ZnetDK 4 Mobile starter App,
2. Copy module's code in the new `./engine/modules/z4m_codegen/` subdirectory,
or from your IDE, pull the code from this module's GitHub repository,
3. Edit the App's [`menu.php`](/../../../znetdk4mobile/blob/master/applications/default/app/menu.php)
located in the [`./applications/default/app/`](/../../../znetdk4mobile/tree/master/applications/default/app/)
subfolder and include the [`menu.inc`](mod/menu.inc) script to add menu item definition for the `z4m_codegen` view.
```php
require ZNETDK_MOD_ROOT . '/z4m_codegen/mod/menu.inc';
```
4. Go to the **Code Generator** menu and generate your CRUD code. 

## CHANGE LOG
See [CHANGELOG.md](CHANGELOG.md) file.

## CONTRIBUTING
Your contribution to the **ZnetDK 4 Mobile** project is welcome. Please refer to the [CONTRIBUTING.md](https://github.com/pascal-martinez/znetdk4mobile/blob/master/CONTRIBUTING.md) file.

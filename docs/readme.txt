Name
====
Product Tare Groups


Version
=======
v1.0.1



Description
===========
This will allow you to set 5 Product Tare Groups you can modify these groups by going to 
Admin -> Locations / Taxes -> Product Tare Groups

The tare values in the Admin -> Configuration -> Shipping/Packaging will no longer work


Affects DB
==========
Yes (creates new records into TABLE_CONFIGURATION)
Adds column to the TABLE_PRODUCTS


DISCLAIMER
==========
Installation of this contribution is done at your own risk.
Backup your ZenCart database and any and all applicable files before proceeding.


Install:
========

1. Backup anything you may be weary of losing. (Everything)
2. Upload the files renaming YOUR_ADMIN to you admin directory
3. Upload or merge the files in the MODIFIED_CORE_FILES. (these files are from a clean version of 1.5.3)
4. Once you load your admin the module will self install.



Tips
====

IF you have any problems with your install, run uninstall.sql it will re-install itself.


UNINSTALL
====
1. Remove all the files included
2. Replace the MODIFIED_CORE_FILES with the original files
3. Run the uninstall.sql

DISCLAIMER
=======
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
(LICENSE) along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

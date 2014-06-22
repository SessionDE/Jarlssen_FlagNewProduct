Jarlssen_FlagNewProduct
=======================

The module allows you to use $_product->getIsNew() inside your template files, to find if the product is new.
It makes some date compare operations over the product attributes news_from_date and news_to_date and sets the flag is_new as true if the product is new.

It coverse the following cases:
 * New from date is set, new to date is not set and the current date is greater than or equal to new from date 
 * New from date is not set, new to date is set and the current date is less than or equal to new to date 
 * New from date is set, new to date is set and the current date is greater than or equal to new from date or is less than or equal to new to date

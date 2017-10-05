# WooCommerce Germanized Extended SEPA Export Usage Value

This Plugin extendeds the SEPA usage value (Ustrd) to:

`Order #, item-names, (optional) Period of first item`

- The Subscription period will only be added if [WooCommerce Subscriptions](https://woocommerce.com/products/woocommerce-subscriptions/) and [WooCommerce Subscriptions Period Meta](https://github.com/holzhannes/woocommerce-subscriptions-period-meta) are enabled.
- Non valid SEPA characters will be replaced. 
- Ustrd will be cutted to fit 140 characters.

## German

Dieses Plugin ändert den Verwendungszweck in der SEPA-Export-Datei zu

`Bestellung 001, Artikelname 1, Artikelname 2, ..., Zeitraum des Abos des 1. Artikels`

- Der Zeitraum des Abos wird nur eingefügt, wenn das Plugin [WooCommerce Subscriptions](https://woocommerce.com/products/woocommerce-subscriptions/) und [WooCommerce Subscriptions Period Meta](https://github.com/holzhannes/woocommerce-subscriptions-period-meta) aktiviert sind.
- Nicht gültige Zeichen werden ersetzt. 
- Der Ververwendungszweck wird auf 140 Zeichen verkürzt.
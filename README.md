# Silverstripe Creator Kit for creating simple Silverstripe Websites
The Silverstripe Creator Kit is a kit for developing Silverstripe Installations with many custom changes directly in the backend without touching the codebase. It includes Elements with Silverstrpe-Elemental, Styling-Options and SiteConfig-Stuff such as a custom Logo, custom colors or custom Text in Header or Footer. There are also alot of configuration options on all elements and sidewide.

# Install
ToDo

# Two options for including SCK
## Option 1: Complete Replacement of Layout for SCK display
Replace the entire Code in Page.ss with 

```<% include Atwx/Sck/Includes/SCKPage Layout=$Layout %>```

With that you can use Header, Footer and Style Blocks of the Creator Kit for your entire page.

## Option 2: Replace only part of your layout
You can use ```<% include Atwx/Sck/Includes/SCKStylings %>``` for importing css from the Creator kit in your <head>

You can use ```<% include Atwx/Sck/Includes/SCKHeader %>``` for importing the SCK edited Header in your <body>

Or you can use ```<% include Atwx/Sck/Includes/SCKFooter %>``` for importing the SCK edited Footer in your <body>

Keep in mind that you have to use the Styling import if you want to use one of the Header, Footer or Elements if you don't plan of styling them yourself.
The Styling also includes the javascript files required for example for the mobile Navigation, the Slider-Element or other interactive parts

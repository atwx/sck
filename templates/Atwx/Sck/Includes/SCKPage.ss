<!doctype html>
<html lang="de">
    <head>
        <% base_tag %>
        $MetaTags(false)
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="utf-8">
        <title>$Title - $SiteConfig.Title</title>
        $ViteClient.RAW
        <link rel="stylesheet" href="$Vite("app/client/src/scss/main.scss")">

        <meta name="twitter:card" content="summary"/>
        <meta name="twitter:site" content="{$Title}"/>
        <meta name="twitter:url" content="{$Link}"/>
        <meta name="twitter:title" content="{$Title} - {$SiteConfig.Title}"/>
        <meta name="twitter:description" content="{$Title}"/>
        <meta name="twitter:image" content="{$SiteConfig.SocialImage.Url}"/>

        <meta property="og:type" content="website"/>
        <meta property="og:title" content="{$Title} - {$SiteConfig.Title}"/>
        <meta property="og:description" content="{$Title}"/>
        <meta property="og:site_name" content="{$SiteConfig.Title}"/>
        <meta property="og:url" content="{$Link}"/>
        <meta property="og:image" content="{$SiteConfig.SocialImage.Url}"/>

        <link rel="manifest" href="site.webmanifest"/>
        <link rel="icon" href="{$SiteConfig.Favicon.Url}" type="image/svg+xml">

        <link rel="apple-touch-icon" sizes="120x120" href="{$SiteConfig.AppleTouchIcon.Fit(120, 120).Url}"/>
        <link rel="apple-touch-icon" sizes="180x180" href="{$SiteConfig.AppleTouchIcon.Fit(180, 180).Url}"/>
        <link rel="mask-icon" href="{$SiteConfig.Favicon.Url}" color="{$SiteConfig.PrimaryColor}"/>
        <meta name="msapplication-TileColor" content="{$SiteConfig.ColorBackground}"/>
        <link rel="apple-touch-icon" sizes="180x180" href="{$SiteConfig.Favicon.Url}"/>

        <% include Atwx/Sck/Includes/SCKStylings %>
    </head>
    <body class="project-body">
        <div class="area_header">
            <% include Atwx/Sck/Includes/SCKHeader %>
        </div>
        <main class="area_content main">
            <% if $SiteConfig.ShowBreadcrumbs %>
                $Breadcrumbs
            <% end_if %>
            $Layout
        </main>
        <script type="module" src="$Vite("app/client/src/js/main.js")"></script>
        <div class="area_footer">
            <% include Atwx/Sck/Includes/SCKFooter %>
        </div>
    </body>
</html>

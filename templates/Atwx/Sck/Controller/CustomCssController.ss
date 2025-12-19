body {
    --MaxWidth: $SiteConfig.MaxWidthValue;
    --MaxWidthContent: $SiteConfig.MaxWidthContentValue;
    --MaxWidthBlockText: $SiteConfig.MaxWidthBlockTextValue;
    --ColorPrimary: $SiteConfig.ColorPrimaryValue;
    --ColorPrimaryDark: $SiteConfig.ColorPrimaryDarkValue;
    --ColorPrimaryLight: $SiteConfig.ColorPrimaryLightValue;
    --ColorSecondary: $SiteConfig.ColorSecondaryValue;
    --ColorSecondaryDark: $SiteConfig.ColorSecondaryDarkValue;
    --ColorSecondaryLight: $SiteConfig.ColorSecondaryLightValue;
    --ColorPrimaryFontWhite: $SiteConfig.ColorPrimaryFontWhite;
    --ColorSecondaryFontWhite: $SiteConfig.ColorSecondaryFontWhite;
    --ColorText: $SiteConfig.ColorTextValue;
    --ColorHeadline: $SiteConfig.ColorHeadlineValue;
    --ColorTextOrigin: $SiteConfig.ColorTextValue;
    --ColorHeadlineOrigin: $SiteConfig.ColorHeadlineValue;
    --ColorMenuBackground: $SiteConfig.ColorMenuBackground;
    --ColorMenuText: $SiteConfig.ColorMenuText;
    --ColorMenuTextHover: $SiteConfig.ColorMenuTextHover;
    <% if $SiteConfig.HeaderFont %>
        --FontHeader: '$SiteConfig.HeaderFont', sans-serif;
    <% end_if %>
    <% if $SiteConfig.BodyFont %>
        --FontBody: '$SiteConfig.BodyFont', sans-serif;
    <% end_if %>
}
<% if $SiteConfig.CustomCSS %>
    $SiteConfig.CustomCSS
<% end_if %>

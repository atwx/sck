body {
    --MaxWidth: $SiteConfig.MaxWidthValue;
    --MaxWidthContent: $SiteConfig.MaxWidthContentValue;
    --MaxWidthBlockText: $SiteConfig.MaxWidthBlockTextValue;
    --ColorPrimary: $SiteConfig.ColorPrimaryValue;
    --ColorSecondary: $SiteConfig.ColorSecondaryValue;
    --ColorPrimaryFontWhite: $SiteConfig.ColorPrimaryFontWhite;
    --ColorSecondaryFontWhite: $SiteConfig.ColorSecondaryFontWhite;
    --ColorText: $SiteConfig.ColorTextValue;
    --ColorHeadline: $SiteConfig.ColorHeadlineValue;
    --ColorTextOrigin: $SiteConfig.ColorTextValue;
    --ColorHeadlineOrigin: $SiteConfig.ColorHeadlineValue;
    <% if $SiteConfig.MenuBackgroundColor %>
        --ColorMenuBand: $SiteConfig.MenuBackgroundColor;
    <% end_if %>
    <% if $SiteConfig.MenuButtonColor %>
        --ColorMenuButton: $SiteConfig.MenuButtonColor;
    <% end_if %>
    <% if $SiteConfig.MenuTextColor %>
        --ColorMenuText: $SiteConfig.MenuTextColor;
    <% end_if %>
    <% if $SiteConfig.MenuTextHoverColor %>
        --ColorMenuTextHover: $SiteConfig.MenuTextHoverColor;
    <% end_if %>
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

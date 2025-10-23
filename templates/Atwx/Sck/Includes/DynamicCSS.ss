<style>
:root {
    --maxWidth: $SiteConfig.MaxWidthValue;
    --maxWidthContent: $SiteConfig.MaxWidthContentValue;
    --ColorPrimary: $SiteConfig.ColorPrimaryValue;
    --ColorSecondary: $SiteConfig.ColorSecondaryValue;
    --ColorPrimaryFontWhite: $SiteConfig.ColorPrimaryFontWhite;
    --ColorSecondaryFontWhite: $SiteConfig.ColorSecondaryFontWhite;
    --ColorText: $SiteConfig.ColorTextValue;
    --ColorHeadline: $SiteConfig.ColorHeadlineValue;
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
}
<% if $SiteConfig.CustomCSS %>
$SiteConfig.CustomCSS
<% end_if %>
</style>

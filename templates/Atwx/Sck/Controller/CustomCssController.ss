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
    <% if $SiteConfig.Headline1FontSize %>
        --Headline1FontSize: $SiteConfig.Headline1FontSize;
    <% end_if %>
    <% if $SiteConfig.Headline1LineHeight %>
        --Headline1LineHeight: $SiteConfig.Headline1LineHeight;
    <% end_if %>
    <% if $SiteConfig.Headline1FontWeight %>
        --Headline1FontWeight: $SiteConfig.Headline1FontWeight;
    <% end_if %>
    <% if $SiteConfig.Headline2FontSize %>
        --Headline2FontSize: $SiteConfig.Headline2FontSize;
    <% end_if %>
    <% if $SiteConfig.Headline2LineHeight %>
        --Headline2LineHeight: $SiteConfig.Headline2LineHeight;
    <% end_if %>
    <% if $SiteConfig.Headline2FontWeight %>
        --Headline2FontWeight: $SiteConfig.Headline2FontWeight;
    <% end_if %>
    <% if $SiteConfig.Headline3FontSize %>
        --Headline3FontSize: $SiteConfig.Headline3FontSize;
    <% end_if %>
    <% if $SiteConfig.Headline3LineHeight %>
        --Headline3LineHeight: $SiteConfig.Headline3LineHeight;
    <% end_if %>
    <% if $SiteConfig.Headline3FontWeight %>
        --Headline3FontWeight: $SiteConfig.Headline3FontWeight;
    <% end_if %>
    <% if $SiteConfig.TextFontSize %>
        --TextFontSize: $SiteConfig.TextFontSize;
    <% end_if %>
    <% if $SiteConfig.TextLineHeight %>
        --TextLineHeight: $SiteConfig.TextLineHeight;
    <% end_if %>
    <% if $SiteConfig.TextFontWeight %>
        --TextFontWeight: $SiteConfig.TextFontWeight;
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

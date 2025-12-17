<% if $Locales %>
    <div class="nav_language">
        <% if $SiteConfig.LanguageToggleVariant == "sharpdropdown" %>
            <% include Atwx\Sck\Includes\LanguageSwitch\LangSwitch_SharpDropdown %>
        <% else_if $SiteConfig.LanguageToggleVariant == "roundeddropdown" %>
            <% include Atwx\Sck\Includes\LanguageSwitch\LangSwitch_RoundedDropdown %>
        <% else_if $SiteConfig.LanguageToggleVariant == "flags" %>
            <% include Atwx\Sck\Includes\LanguageSwitch\LangSwitch_Flags %>
        <% else_if $SiteConfig.LanguageToggleVariant == "list" %>
            <% include Atwx\Sck\Includes\LanguageSwitch\LangSwitch_List %>
        <% end_if %>
    </div>
<% end_if %>

<div class="section section--TextImageElement $Variant $BackgroundColor <% if $SiteConfig.ColorPrimaryFontWhite && $BackgroundColor == 'bgc-primary' %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite && $BackgroundColor == 'bgc-secondary' %>secondary-white-text<% end_if %>">
    <div class="section_content $ImgWidth">
        <% if $Image %>
            <div class="section_image">
                <% if $Image %>
                    $Image.ScaleWidth(800)
                <% end_if %>

            </div>
        <% end_if %>
        <% if $SideLinks.Count > 0 %>
            <div class="section_links">
                <% if $LinksTitle %>
                    <h2 class="section_links_title">$LinksTitle</h2>
                <% end_if %>
                <% loop $SideLinks %>
                    <a href="$URL" class="section_link">$Title</a>
                <% end_loop %>
            </div>
        <% end_if %>

        <div class="section_text">
            <h2 class="hl2 section_title">$Title</h2>
            <div class="section_text_content">
                $Text
            </div>
            <% if $Button %>
                <div class="section_button">
                    <% include Atwx/Sck/Includes/Button Link=$Button, BackgroundColor=$BackgroundColor %>
                </div>
            <% end_if %>
        </div>
    </div>
</div>

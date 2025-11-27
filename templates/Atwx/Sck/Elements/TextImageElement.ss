<section class="section--TextImageElement $Variant $BackgroundColor $ColumnRatio $ElementDecoration $ImgWidth <% if $SiteConfig.ColorPrimaryFontWhite && $BackgroundColor == 'bgc-primary' %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite && $BackgroundColor == 'bgc-secondary' %>secondary-white-text<% end_if %>">
    <div class="section_content">
        <% if $Image %>
            <div class="section_image">
                $Image.ScaleWidth(800)
            </div>
        <% else_if $VideoLink %>
            <div class="section_video">
                <iframe width="100%" height="100%" src="https://www.youtube-nocookie.com/embed/$VideoLink?rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        <% end_if %>
        <% if $SideLinks.Count > 0 %>
            <div class="section_links">
                <ul>
                    <% if $LinksTitle %>
                        <li>
                            <h2 class="section_links_title">$LinksTitle</h2>
                        </li>
                    <% end_if %>
                    <% loop $SideLinks %>
                        <li>
                            <a href="$URL" class="section_link">$Title</a>
                        </li>
                    <% end_loop %>
                </ul>
            </div>
        <% end_if %>
        <% if $ShowTitle %>
            <h2 class="hl2 section_title">$Title</h2>
        <% end_if %>
        <div class="section_text_content">
            $Text
            <% if $Button %>
                <div class="section_button">
                    <% include Atwx/Sck/Includes/Button Link=$Button, BackgroundColor=$BackgroundColor %>
                </div>
            <% end_if %>
        </div>
    </div>
</section>

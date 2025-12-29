<section class="section--HighlightElement $BackgroundColor $ElementDecoration variant--$Variant <% if $SiteConfig.ColorPrimaryFontWhite %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite %>secondary-white-text<% end_if %>" <% if $Image %>style="background-image: url('$Image.URL');"<% end_if %>>
    <div class="section_content animation--$FadeInAnimation">
        <div class="section_content_inner">
            <% if $ShowTitle && $Title %>
                <h2 class="hl2 section_title">$Title</h2>
            <% end_if %>

            <% if $Content %>
                <div class="section_text">
                    $Content
                </div>
            <% end_if %>

            <% if $Buttons.Count > 0 %>
                <div class="section_links">
                    <% loop $Buttons %>
                        <% include Atwx/Sck/Includes/Button Link=$Me, BackgroundColor=$Top.BackgroundColor %>
                    <% end_loop %>
                </div>
            <% end_if %>
        </div>
    </div>
</section>

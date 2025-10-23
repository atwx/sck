<div class="section section--TextImageElement $Variant $ImgWidth $BackgroundColor <% if $SiteConfig.ColorPrimaryFontWhite && $BackgroundColor == 'bgc-primary' %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite && $BackgroundColor == 'bgc-secondary' %>secondary-white-text<% end_if %>">
    <div class="container">
        <div class="section_content">
            <% if $Image %>
                <div class="section_image">
                    $Image.ScaleWidth(800)
                </div>
            <% end_if %>

            <div class="section_text">
                <h2 class="section_title">$Title</h2>
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
</div>

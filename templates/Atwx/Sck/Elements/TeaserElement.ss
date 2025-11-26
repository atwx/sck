<section class="section--TeaserElement $BackgroundColor $ElementDecoration <% if $SiteConfig.ColorPrimaryFontWhite && $BackgroundColor == 'bgc-primary' %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite && $BackgroundColor == 'bgc-secondary' %>secondary-white-text<% end_if %>">
    <div class="section_content">
        <% if $Title %>
            <h2 class="hl2 teaser-title">$Title</h2>
        <% end_if %>
        <% if $TeaserItems %>
            <div class="teaser-grid columns-$NumberColumns">
                <% loop $TeaserItems %>
                    <div class="teaser-item">
                        <% if $Image %>
                            <div class="teaser-item-image">
                                $Image.ScaleWidth(1200)
                            </div>
                        <% end_if %>

                        <div class="teaser-item-content">
                            <% if $Title %>
                                <h3 class="teaser-item-title">$Title</h3>
                            <% end_if %>

                            <% if $Content %>
                                <div class="teaser-item-text">
                                    $Content
                                </div>
                            <% end_if %>

                            <% if $Button && $Button.exists() %>
                                <% include Atwx/Sck/Includes/Button Link=$Button %>
                            <% end_if %>
                        </div>
                    </div>
                <% end_loop %>
            </div>
        <% end_if %>
    </div>
</section>

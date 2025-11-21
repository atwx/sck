<section class="section--NewsElement $BackgroundColor <% if $SiteConfig.ColorPrimaryFontWhite && $BackgroundColor == 'bgc-primary' %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite && $BackgroundColor == 'bgc-secondary' %>secondary-white-text<% end_if %>">
    <div class="section_content">
        <div class="section_intro">
            <% if $Title %>
                <h2 class="hl2 section_title">$Title</h2>
            <% end_if %>
            <% if $Subtitle %>
                <h3 class="section_subtitle">$Subtitle</h3>
            <% end_if %>
            <% if $Description %>
                <div class="section_description">
                    $Description
                </div>
            <% end_if %>
        </div>

        <% if $NewsItems %>
            <div class="news_list">
                <% loop $NewsItems %>
                    <a href="$Link" class="news_link_overlay" aria-label="Mehr erfahren zu $Title">
                        <div class="news_item">
                            <% if $Top.PrefixIcon %>
                                <div class="news_item_prefix">
                                    <img src="$Top.PrefixIcon.URL" alt="$Top.PrefixIcon.Title" />
                                </div>
                            <% end_if %>
                            <div class="news_item_content">
                                <% if $Title %>
                                    <p class="news_item_title">$Title</p>
                                <% end_if %>
                            </div>
                        </div>
                    </a>
                <% end_loop %>
            </div>
        <% end_if %>

        <% if $MainButton %>
            <div class="section_button">
                <% include Atwx/Sck/Includes/Button Link=$MainButton, BackgroundColor=$BackgroundColor %>
            </div>
        <% end_if %>
    </div>
</section>

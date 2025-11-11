<div class="section section--TwoColumnTextElement $Layout title-vertical-$TitleVerticalPosition $BackgroundColor <% if $SiteConfig.ColorPrimaryFontWhite && $BackgroundColor == 'bgc-primary' %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite && $BackgroundColor == 'bgc-secondary' %>secondary-white-text<% end_if %>">
    <div class="section_content">
        <div class="two-column-content">
            <% if $LeftTitle %>
                <div class="title-column">
                        <h2 class="element-title">$LeftTitle</h2>
                </div>
            <% end_if %>
            <% if $RightText %>
                <div class="text-column">
                    <div class="element-text">$RightText</div>
                </div>
            <% end_if %>
        </div>
    </div>
</div>

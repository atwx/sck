<section class="section--TwoColumnTextElement $Layout $ElementDecoration $FadeInAnimation <% if not $TitleVerticalPositionAlternative %> title-vertical-$TitleVerticalPosition<% end_if %> $BackgroundColor <% if $SiteConfig.ColorPrimaryFontWhite && $BackgroundColor == 'bgc-primary' %>primary-white-text<% end_if %> <% if $SiteConfig.ColorSecondaryFontWhite && $BackgroundColor == 'bgc-secondary' %>secondary-white-text<% end_if %>">
    <div class="section_content">
        <div class="two-column-content" style="--TitleWidth: {$TitleWidth}%;<% if $TitleVerticalPositionAlternative %> --TitleVerticalPosition: {$TitleVerticalPositionAlternative};<% end_if %>">
            <% if $Title %>
                <div class="title-column">
                    <% if $ShowTitle %>
                        <h2 class="hl2 element-title">$Title</h2>
                    <% end_if %>
                </div>
            <% end_if %>
            <% if $RightText %>
                <div class="text-column">
                    <div class="element-text">$RightText</div>
                </div>
            <% end_if %>
        </div>
    </div>
</section>

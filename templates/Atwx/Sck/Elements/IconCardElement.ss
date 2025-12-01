<section class="section--IconCardElement $BackgroundColor $ElementDecoration">
    <div class="section_content animation--$FadeInAnimation">
        <div class="align-{$Alignment} vertical-{$VerticalPosition} horizontal-($HorizontalAlignment} <% if $BackgroundImage %> has-bg<% end_if %>">
            <% if $BackgroundImage %>
                <div class="background_image">
                    $BackgroundImage
                </div>
            <% end_if %>
            <div class="content vertical-{$VerticalPosition} horizontal-{$HorizontalAlignment}" style="background-color: {$BackgroundContentColor}">
                <% if $Symbol %>
                    <div class="icon align-{$Alignment}">
                        <% if $Symbol.Extension == 'svg' %>
                            $Symbol
                        <% else %>
                            <img src="$Symbol.URL" alt="Icon" loading="lazy" />
                        <% end_if %>
                    </div>
                <% end_if %>
                <% if $ShowTitle %>
                    <h2 class="title align-{$Alignment}" style="color: {$TitleColor}">$Title</h2>
                <% end_if %>
                <% if $Text %>
                    <div class="text align-{$Alignment}" style="color: {$TextColor}">
                        $Text
                    </div>
                <% end_if %>
                <div class="button align-{$Alignment}">
                    <% if $Button %>
                            <% include Atwx/Sck/Includes/Button Link=$Button %>
                    <% end_if %>
                </div>
            </div>
        </div>
    </div>
</section>

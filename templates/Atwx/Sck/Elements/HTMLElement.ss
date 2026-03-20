<section class="section--HTMLElement">
    <div class="section_content">
        <% if $Title %>
            <% if $UseH1ForTitle %>
                <h1 class="hl1 element-title">$Title</h1>
            <% else %>
                <h2 class="hl2 element-title">$Title</h2>
            <% end_if %>
        <% end_if %>

        <div class="html-content">
            $HTMLContent.Raw
            <style>
                html > body {
                    font-family: var(--FontBody);
                }
            </style>
        </div>
    </div>
</section>

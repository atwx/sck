<div class="contact-persons-element">
    <div class="container">
        <% if $Title %>
        <h2 class="hl2 main-title">$Title</h2>
        <% end_if %>
        
        <div class="contact-persons-grid">
            <% if $Persons.Count > 0 %>
                <% loop $Persons %>
                    <div class="contact-person">
                        <% if $Image %>
                            <div class="contact-photo">
                                <img src="$Image.URL" alt="$Name" loading="lazy" />
                            </div>
                        <% end_if %>
                        
                        <div class="contact-info">
                            <h3 class="contact-name">$getTitle()</h3>
                            <% if $Function %>
                                <div class="contact-function">$Function</div>
                            <% end_if %>
                            
                            <% if $Groups.Count > 0 %>
                                <div class="contact-group"> 
                                    <% loop $Groups %>$Title<% if not $IsLast %>, <% end_if %><% end_loop %>
                                </div>
                                
                                <div class="contact-department">$Department</div>
                            <% end_if %>
                            
                            <div class="contact-details">
                                <% if $Telephone %>
                                    <div class="contact-phone">
                                        <strong>Tel.:</strong> $Telephone
                                    </div>
                                <% end_if %>
                                
                                <% if $Email %>
                                    <div class="contact-email">
                                        <a href="mailto:$Email">$Email</a>
                                    </div>
                                <% end_if %>
                            </div>
                        </div>
                    </div>
                <% end_loop %>
            <% end_if %>
            
            <% if $Person2Name %>
            <div class="contact-person">
                <% if $Person2Image %>
                <div class="contact-photo">
                    <img src="$Person2Image.URL" alt="$Person2Name" loading="lazy" />
                </div>
                <% end_if %>
                
                <div class="contact-info">
                    <h3 class="contact-name">$Person2Name</h3>
                    <% if $Person2Position %>
                    <div class="contact-position">$Person2Position</div>
                    <% end_if %>
                    
                    <% if $Person2Department %>
                    <div class="contact-department">$Person2Department</div>
                    <% end_if %>
                    
                    <div class="contact-details">
                        <% if $Person2Phone %>
                        <div class="contact-phone">
                            <strong>Tel.:</strong> $Person2Phone
                        </div>
                        <% end_if %>
                        
                        <% if $Person2Mobile %>
                        <div class="contact-mobile">
                            <strong>Mobil:</strong> $Person2Mobile
                        </div>
                        <% end_if %>
                        
                        <% if $Person2Email %>
                        <div class="contact-email">
                            <a href="mailto:$Person2Email">$Person2Email</a>
                        </div>
                        <% end_if %>
                    </div>
                    
                    <div class="contact-button">
                        <span class="btn-contact">
                            > Kontakt
                        </span>
                    </div>
                </div>
            </div>
            <% end_if %>
        </div>
    </div>
</div>

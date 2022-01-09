/* Inpsyde Userlist API Plugin */

let jsonPlaceholder = "https://jsonplaceholder.typicode.com/users/";

((url) => {
    fetch(url)
        .then(async(response) => {
            records = await response.json();
            printRecordsHTML(records);
        })
        .catch((err) => {
            jQuery("#users_table_container .loader-container").remove();
            alert("Network Error: Unable to fetch Users Data ");
            console.log(err);
        });
})(jsonPlaceholder);

let printRecordsHTML = (records) => {
    jQuery("#users_table_container .loader-container").remove();

    let table = document.querySelector("#users_table tbody");
    records.forEach((item) => {
        table.innerHTML += `<tr class="user-row">
            <td><a href="#details" class="info-link" data-id="${item.id}">${item.id}</a></td>
            <td><a href="#details" class="info-link" data-id="${item.id}">${item.name}</a></td>
            <td><a href="#details" class="info-link" data-id="${item.id}">${item.username}</a></td>
            <td><a href="#details" class="info-link" data-id="${item.id}">${item.email}</a></td>
        </tr>`;
    });

    jQuery(".info-link").click((e) => {
        // e.preventDefault();
        singleUserInfo(parseInt(e.target.getAttribute("data-id")));
    });
};

let singleUserInfo = (id) => {
    jQuery(".user-info").slideDown();
    jQuery(".user-info .loader-container").fadeIn();

    //forcing cache for fetch requests as mentioned in the task description
    fetch(jsonPlaceholder + id, { cache: "force-cache" })
        .then(async(response) => {
            let data = await response.json();
            printUserHTML(data);
        })
        .catch((err) => {
            alert("Network Error : Unable to get user details ");
            console.log(err);
            jQuery(".user-info").slideUp();
        });
};

let printUserHTML = (user) => {
    //make and append html markup
    let html = `<div class="details-grid">
                    <div><span class="bold">Name</span> <span>${user.name}</span></div>
                    <div><span class="bold">Username</span> <span>${user.username}</span></div>
                    <div><span class="bold">Email</span> <span>${user.email}</span></div>
                    <div><span class="bold">Phone#</span> <span>${user.phone}</span></div>
                    <div><span class="bold">Website</span> <span><a href="http://${user.website}" target="_blank">${user.website}</a></span></div>
                    </br>
                    <h4 class="bold">User address</h4> 
                    <div class="padding-left-20">
                        <span class="bold">Street</span><span>${user.address.street}</span>
                        <span class="bold">Suite</span><span>${user.address.suite}</span>
                        <span class="bold">City</span><span>${user.address.city}</span>
                        <span class="bold">Zipcode</span><span>${user.address.zipcode}</span>
                        <span class="bold">Geo</span><span>Lat: ${user.address.geo.lat}  Lng: ${user.address.geo.lng}</span>
                    </div>
                    </br>
                    <h4 class="bold">Company info</h4>
                    <div class="padding-left-20">
                        <span class="bold">Name</span><span>${user.company.name}</span>
                        <span class="bold">Catch phrase</span><span>${user.company.catchPhrase}</span>
                        <span class="bold">Business</span><span>${user.company.bs}</span>
                    </div>
                </div>`;
    jQuery(".user-info .user-details ").html(html);
    jQuery(".user-info .loader-container").fadeOut();
};
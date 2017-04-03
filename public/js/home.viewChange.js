var flag = 0; // 0: magazine_view 1: list_view
// console.log("data on kirikae");
// console.log(data);

function listViewMode() {
    document.getElementById("header-innner-wrap").style.maxWidth="90%";
    document.getElementById("header-innner-wrap").style.maxWidth="90%";
    document.getElementById("wrap").style.maxWidth="95%";
    document.getElementById("wrap").style.width="95%";
    flag = 1;
    console.log("flag = "+flag);
}
function magazineViewMode() {
    document.getElementById("header-innner-wrap").style.maxWidth="620px";
    document.getElementById("header-innner-wrap").style.maxWidth="620px";
    document.getElementById("wrap").style.maxWidth="620px";
    document.getElementById("wrap").style.width="620px";
    flag = 0;
    console.log("flag = "+flag);
}

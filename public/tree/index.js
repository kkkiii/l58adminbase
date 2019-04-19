$(function(){
    $("#simple-treeview").dxTreeView({
        items: products,
        width: 300,
        onItemClick: function(e) {
            var item = e.itemData;

                $("#product-details").removeClass("hidden");
                $("#product-details > #btn_del").attr("href", "/admin/govmgr.org_list_del/"+item.id);
                $("#product-details > #btn_edit").attr("href", "/admin/govmgr.org_list_edit/"+item.id);
            $("#product-details > #btn_sub").attr("href", "/admin/govmgr.org_list_sub/"+item.id);
            // $("#product-details > #btn_root").attr("href", "/admin/govmgr.org_list_root");
                $("#product-details > .name").text(item.text + "|" + item.id);

        }
    }).dxTreeView("instance");
});
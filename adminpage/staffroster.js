// Takvimin açılacağı input elemanını seçiyoruz
$(function() {
    $("#datepicker").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        showWeek: true,
        onSelect: function(selectedDate) {
            // Kullanıcı bir tarih seçtiğinde bu fonksiyon tetiklenecek
            console.log("Seçilen tarih: " + selectedDate);
        }
    });
});

function getSelectedWeek() {
    // Seçilen tarihi al
    var selectedDate = $("#datepicker").val();
    
    if (selectedDate !== '') {
        // Seçilen tarihin hafta numarasını hesapla
        var dateObject = new Date(selectedDate);
        var weekNumber = getWeekNumber(dateObject);
        
        // Hafta numarasını kullanıcıya göster
        alert("Seçilen haftanın numarası: " + weekNumber);
    } else {
        alert("Lütfen bir tarih seçin!");
    }
}

function getWeekNumber(date) {
    // Date objesinden hafta numarasını hesaplamak için kullanılacak fonksiyon
    var d = new Date(date);
    d.setHours(0, 0, 0, 0);
    d.setDate(d.getDate() + 4 - (d.getDay() || 7));
    var yearStart = new Date(d.getFullYear(), 0, 1);
    var weekNo = Math.ceil((( ( (d - yearStart) / 86400000) + 1) / 7));
    return weekNo;
}

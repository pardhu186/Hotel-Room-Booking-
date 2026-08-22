(function () {
  var KEY = "hotel-bookings-v1";

  function load() {
    try {
      return JSON.parse(localStorage.getItem(KEY) || "[]");
    } catch (e) {
      return [];
    }
  }

  function save(list) {
    localStorage.setItem(KEY, JSON.stringify(list));
  }

  function nights(cin, cout) {
    var a = new Date(cin);
    var b = new Date(cout);
    var n = Math.round((b - a) / 86400000);
    return n > 0 ? n : 1;
  }

  function rateOf(room) {
    if (room.indexOf("single") === 0) return 500;
    if (room.indexOf("double") === 0) return 750;
    return 1000;
  }

  function createBooking(event) {
    event.preventDefault();
    var form = event.target;
    var name = form.uname.value.trim();
    var mobile = form.mobno.value.trim();
    var email = form.mailid.value.trim();
    var pass = form.pass.value;
    var cin = form.cindate.value;
    var cout = form.coutdate.value;
    var room = form.rtype.value;
    var city = form.city.value;
    if (!name || !mobile || !email || !pass || !cin || !cout || !room) {
      alert("Please fill all the fields");
      return false;
    }
    var list = load();
    var booking = {
      id: Date.now(),
      name: name,
      mobile: mobile,
      email: email,
      pass: pass,
      city: city,
      date1: cin,
      date2: cout,
      room: room,
      roomNo: 100 + list.length + 1,
      amount: nights(cin, cout) * rateOf(room),
      paid: false
    };
    list.push(booking);
    save(list);
    localStorage.setItem("hotel-last-booking", String(booking.id));
    alert("Registration success!!");
    window.location.href = "ackn.html";
    return false;
  }

  function findBookings(name, pass) {
    return load().filter(function (b) {
      return b.name === name && b.pass === pass;
    });
  }

  function lookup(event) {
    event.preventDefault();
    var name = event.target.uname.value.trim();
    var pass = event.target.mobno.value;
    var rows = findBookings(name, pass);
    var body = document.getElementById("ack-body");
    body.innerHTML = "";
    if (!rows.length) {
      alert("No booking found for that name and password.");
      document.getElementById("pay-wrap").style.display = "none";
      return false;
    }
    var total = 0;
    rows.forEach(function (b) {
      total += b.amount;
      var tr = document.createElement("tr");
      tr.innerHTML =
        "<td>" + b.name + "</td><td>" + b.mobile + "</td><td>" + b.date1 +
        "</td><td>" + b.date2 + "</td><td>" + b.roomNo + "</td><td>" + b.room +
        "</td><td>" + b.amount + (b.paid ? " (paid)" : "") + "</td>";
      body.appendChild(tr);
    });
    var payAmount = document.getElementById("payamount");
    if (payAmount) payAmount.value = total;
    localStorage.setItem("hotel-pay-ids", JSON.stringify(rows.map(function (b) { return b.id; })));
    var wrap = document.getElementById("pay-wrap");
    if (wrap) wrap.style.display = "block";
    return false;
  }

  function showLastBooking() {
    var id = localStorage.getItem("hotel-last-booking");
    var list = load();
    var found = list.filter(function (b) { return String(b.id) === String(id); });
    var body = document.getElementById("ack-body");
    if (!body) return;
    body.innerHTML = "";
    if (!found.length) return;
    found.forEach(function (b) {
      var tr = document.createElement("tr");
      tr.innerHTML =
        "<td>" + b.name + "</td><td>" + b.mobile + "</td><td>" + b.date1 +
        "</td><td>" + b.date2 + "</td><td>" + b.roomNo + "</td><td>" + b.room +
        "</td><td>" + b.amount + (b.paid ? " (paid)" : "") + "</td>";
      body.appendChild(tr);
    });
    var payAmount = document.getElementById("payamount");
    if (payAmount) payAmount.value = found[0].amount;
    localStorage.setItem("hotel-pay-ids", JSON.stringify(found.map(function (b) { return b.id; })));
  }

  function pay(event) {
    event.preventDefault();
    var accname = event.target.accname.value.trim();
    var accno = event.target.accno.value.trim();
    if (!accname || !accno) {
      alert("Enter account holder name and account number.");
      return false;
    }
    var ids = JSON.parse(localStorage.getItem("hotel-pay-ids") || "[]");
    var list = load().map(function (b) {
      if (ids.indexOf(b.id) !== -1) b.paid = true;
      return b;
    });
    save(list);
    alert("Payment success!!");
    window.location.href = "index.html";
    return false;
  }

  window.Hotel = {
    createBooking: createBooking,
    lookup: lookup,
    showLastBooking: showLastBooking,
    pay: pay
  };
})();

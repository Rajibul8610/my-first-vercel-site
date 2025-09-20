<!doctype html>
<html lang="bn">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>HEMS — পরীক্ষার ফলাফল অনুসন্ধান</title>
  <style>
    :root{
      --bg:#f4f7fb;
      --card:#fff;
      --accent:#0b74de;
      --accent-2:#0a63b8;
      --muted:#6b7280;
      --radius:10px;
      --container:1100px;
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;font-family: "Noto Sans Bengali", Arial, sans-serif;background:var(--bg);color:#0b1724}
    .container{max-width:var(--container);margin:28px auto;padding:18px}
    header{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px}
    .brand{display:flex;align-items:center;gap:12px}
    .logo{
      width:56px;height:56px;border-radius:8px;background:linear-gradient(135deg,var(--accent),var(--accent-2));
      display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:18px;
      box-shadow:0 6px 20px rgba(11,116,222,0.12);
    }
    h1{font-size:1.1rem;margin:0}
    .lead{color:var(--muted);font-size:0.95rem}
    .card{background:var(--card);border-radius:var(--radius);padding:18px;box-shadow:0 8px 30px rgba(15,23,42,0.06)}
    .grid{display:grid;grid-template-columns:2fr 1fr;gap:16px}
    .form-row{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-bottom:12px}
    label{font-size:0.86rem;color:var(--muted);margin-bottom:6px;display:block}
    input[type="text"], select {width:100%;padding:10px 12px;border-radius:8px;border:1px solid #e6eef8;font-size:0.95rem}
    button{background:var(--accent);border:0;color:#fff;padding:10px 14px;border-radius:8px;cursor:pointer;font-weight:600}
    button:active{transform:translateY(1px)}
    .muted{color:var(--muted);font-size:0.9rem}
    .results{margin-top:14px}
    table{width:100%;border-collapse:collapse}
    th,td{padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:0.95rem;text-align:left}
    th{background:#fbfdff;color:#0b1724}
    .empty{padding:18px;text-align:center;color:var(--muted)}
    .sidebar .card {padding:12px}
    .list{list-style:none;padding:0;margin:0}
    .list li{padding:8px 6px;border-radius:8px;margin-bottom:8px;background:#f8fbff}
    .link{color:var(--accent);text-decoration:none}
    .small{font-size:0.85rem;color:var(--muted)}
    .footer{margin-top:18px;text-align:center;color:var(--muted);font-size:0.88rem}
    .controls{display:flex;gap:8px;align-items:center}
    .btn-ghost{background:transparent;border:1px solid #e6eef8;color:var(--muted);padding:8px 10px;border-radius:8px}
    @media (max-width:860px){
      .grid{grid-template-columns:1fr}
      .form-row{grid-template-columns:1fr}
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <div class="brand">
        <div class="logo">HE</div>
        <div>
          <h1>Al-Haiatul Ulya — ফলাফল অনুসন্ধান</h1>
          <div class="lead">পরীক্ষার রোল/রেজিস্ট্রেশন/মাদরাসা কোড দ্বারা ফলাফল দেখুন</div>
        </div>
      </div>
      <div class="small">ডেমো স্ট্যাটিক পেজ • আপনি চাইলে API ইন্টিগ্রেশন করাতে পারেন</div>
    </header>

    <main class="grid">
      <!-- প্রধান অংশ -->
      <section class="card">
        <h2 style="margin-top:0">ফলাফল অনুসন্ধান</h2>

        <form id="searchForm" onsubmit="return false" aria-label="ফলাফল অনুসন্ধান ফর্ম">
          <div class="form-row">
            <div>
              <label for="examSelect">পরীক্ষা</label>
              <select id="examSelect" aria-label="পরীক্ষা নির্বাচন">
                <option value="ssc">এসএসসি (উদাহরণ)</option>
                <option value="dakhil">দাখিল</option>
                <option value="alim">আলিম</option>
                <option value="fazil">ফাজিল</option>
              </select>
            </div>

            <div>
              <label for="yearSelect">সাল</label>
              <select id="yearSelect" aria-label="সাল নির্বাচন">
                <option value="2024">২০২৪</option>
                <option value="2023">২০২৩</option>
                <option value="2022">২০২২</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div>
              <label for="searchBy">অনুসন্ধান পদ্ধতি</label>
              <select id="searchBy">
                <option value="roll">রোল নং</option>
                <option value="reg">রেজি. নং</option>
                <option value="madrasa">মাদরাসা কোড</option>
              </select>
            </div>

            <div>
              <label for="queryInput">রোল/রেজি/মাদরাসা কোড লিখুন</label>
              <input id="queryInput" type="text" placeholder="উদাহরণ: 123456" />
            </div>
          </div>

          <div style="display:flex;gap:8px;align-items:center;margin-top:6px">
            <button id="searchBtn" type="button">অনুসন্ধান</button>
            <button id="clearBtn" type="button" class="btn-ghost">সাফ করুন</button>
            <div style="margin-left:auto" class="small">ডেমো: নমুনা ডেটা ব্যবহার করে ফলাফল দেখায়</div>
          </div>
        </form>

        <div class="results card" id="resultsArea" style="margin-top:12px">
          <div id="resultsHeader" style="display:flex;align-items:center;justify-content:space-between">
            <div style="font-weight:700">ফলাফল তালিকা</div>
            <div class="small" id="resultsCount">—</div>
          </div>

          <div id="resultsTableWrap" style="margin-top:8px">
            <!-- যদি ফলাফল না থাকে তখন এখানে দেখাবে -->
            <div class="empty" id="noResults">অনুসন্ধান দিন অথবা ডেমো রোল দিয়ে দেখুন</div>

            <table id="resultsTable" style="display:none">
              <thead>
                <tr>
                  <th>রোল</th>
                  <th>নাম</th>
                  <th>মাদরাসা</th>
                  <th>বোর্ড/পাঠক্রম</th>
                  <th>মোট নম্বর</th>
                  <th>স্ট্যাটাস</th>
                  <th>বিস্তারিত</th>
                </tr>
              </thead>
              <tbody id="resultsBody"></tbody>
            </table>
          </div>

          <div id="pagination" style="margin-top:8px;display:flex;gap:8px;justify-content:flex-end;align-items:center"></div>
        </div>
      </section>

      <!-- সাইডবার -->
      <aside class="sidebar">
        <div class="card">
          <h3 style="margin-top:0">দ্রুত লিঙ্ক</h3>
          <ul class="list">
            <li><a class="link" href="#" onclick="showMerit('district')">জেলা ভিত্তিক মেধা তালিকা</a></li>
            <li><a class="link" href="#" onclick="showMerit('national')">জাতীয় মেধা তালিকা</a></li>
<!doctype html>
<html lang="bn">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>HEMS — পরীক্ষার ফলাফল অনুসন্ধান</title>
  <style>
    :root{
      --bg:#f4f7fb;
      --card:#fff;
      --accent:#0b74de;
      --accent-2:#0a63b8;
      --muted:#6b7280;
      --radius:10px;
      --container:1100px;
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;font-family: "Noto Sans Bengali", Arial, sans-serif;background:var(--bg);color:#0b1724}
    .container{max-width:var(--container);margin:28px auto;padding:18px}
    header{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px}
    .brand{display:flex;align-items:center;gap:12px}
    .logo{
      width:56px;height:56px;border-radius:8px;background:linear-gradient(135deg,var(--accent),var(--accent-2));
      display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:18px;
      box-shadow:0 6px 20px rgba(11,116,222,0.12);
    }
    h1{font-size:1.1rem;margin:0}
    .lead{color:var(--muted);font-size:0.95rem}
    .card{background:var(--card);border-radius:var(--radius);padding:18px;box-shadow:0 8px 30px rgba(15,23,42,0.06)}
    .grid{display:grid;grid-template-columns:2fr 1fr;gap:16px}
    .form-row{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-bottom:12px}
    label{font-size:0.86rem;color:var(--muted);margin-bottom:6px;display:block}
    input[type="text"], select {width:100%;padding:10px 12px;border-radius:8px;border:1px solid #e6eef8;font-size:0.95rem}
    button{background:var(--accent);border:0;color:#fff;padding:10px 14px;border-radius:8px;cursor:pointer;font-weight:600}
    button:active{transform:translateY(1px)}
    .muted{color:var(--muted);font-size:0.9rem}
    .results{margin-top:14px}
    table{width:100%;border-collapse:collapse}
    th,td{padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:0.95rem;text-align:left}
    th{background:#fbfdff;color:#0b1724}
    .empty{padding:18px;text-align:center;color:var(--muted)}
    .sidebar .card {padding:12px}
    .list{list-style:none;padding:0;margin:0}
    .list li{padding:8px 6px;border-radius:8px;margin-bottom:8px;background:#f8fbff}
    .link{color:var(--accent);text-decoration:none}
    .small{font-size:0.85rem;color:var(--muted)}
    .footer{margin-top:18px;text-align:center;color:var(--muted);font-size:0.88rem}
    .controls{display:flex;gap:8px;align-items:center}
    .btn-ghost{background:transparent;border:1px solid #e6eef8;color:var(--muted);padding:8px 10px;border-radius:8px}
    @media (max-width:860px){
      .grid{grid-template-columns:1fr}
      .form-row{grid-template-columns:1fr}
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <div class="brand">
        <div class="logo">HE</div>
        <div>
          <h1>Al-Haiatul Ulya — ফলাফল অনুসন্ধান</h1>
          <div class="lead">পরীক্ষার রোল/রেজিস্ট্রেশন/মাদরাসা কোড দ্বারা ফলাফল দেখুন</div>
        </div>
      </div>
      <div class="small">ডেমো স্ট্যাটিক পেজ • আপনি চাইলে API ইন্টিগ্রেশন করাতে পারেন</div>
    </header>

    <main class="grid">
      <!-- প্রধান অংশ -->
      <section class="card">
        <h2 style="margin-top:0">ফলাফল অনুসন্ধান</h2>

        <form id="searchForm" onsubmit="return false" aria-label="ফলাফল অনুসন্ধান ফর্ম">
          <div class="form-row">
            <div>
              <label for="examSelect">পরীক্ষা</label>
              <select id="examSelect" aria-label="পরীক্ষা নির্বাচন">
                <option value="ssc">এসএসসি (উদাহরণ)</option>
                <option value="dakhil">দাখিল</option>
                <option value="alim">আলিম</option>
                <option value="fazil">ফাজিল</option>
              </select>
            </div>

            <div>
              <label for="yearSelect">সাল</label>
              <select id="yearSelect" aria-label="সাল নির্বাচন">
                <option value="2024">২০২৪</option>
                <option value="2023">২০২৩</option>
                <option value="2022">২০২২</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div>
              <label for="searchBy">অনুসন্ধান পদ্ধতি</label>
              <select id="searchBy">
                <option value="roll">রোল নং</option>
                <option value="reg">রেজি. নং</option>
                <option value="madrasa">মাদরাসা কোড</option>
              </select>
            </div>

            <div>
              <label for="queryInput">রোল/রেজি/মাদরাসা কোড লিখুন</label>
              <input id="queryInput" type="text" placeholder="উদাহরণ: 123456" />
            </div>
          </div>

          <div style="display:flex;gap:8px;align-items:center;margin-top:6px">
            <button id="searchBtn" type="button">অনুসন্ধান</button>
            <button id="clearBtn" type="button" class="btn-ghost">সাফ করুন</button>
            <div style="margin-left:auto" class="small">ডেমো: নমুনা ডেটা ব্যবহার করে ফলাফল দেখায়</div>
          </div>
        </form>

        <div class="results card" id="resultsArea" style="margin-top:12px">
          <div id="resultsHeader" style="display:flex;align-items:center;justify-content:space-between">
            <div style="font-weight:700">ফলাফল তালিকা</div>
            <div class="small" id="resultsCount">—</div>
          </div>

          <div id="resultsTableWrap" style="margin-top:8px">
            <!-- যদি ফলাফল না থাকে তখন এখানে দেখাবে -->
            <div class="empty" id="noResults">অনুসন্ধান দিন অথবা ডেমো রোল দিয়ে দেখুন</div>

            <table id="resultsTable" style="display:none">
              <thead>
                <tr>
                  <th>রোল</th>
                  <th>নাম</th>
                  <th>মাদরাসা</th>
                  <th>বোর্ড/পাঠক্রম</th>
                  <th>মোট নম্বর</th>
                  <th>স্ট্যাটাস</th>
                  <th>বিস্তারিত</th>
                </tr>
              </thead>
              <tbody id="resultsBody"></tbody>
            </table>
          </div>

          <div id="pagination" style="margin-top:8px;display:flex;gap:8px;justify-content:flex-end;align-items:center"></div>
        </div>
      </section>

      <!-- সাইডবার -->
      <aside class="sidebar">
        <div class="card">
          <h3 style="margin-top:0">দ্রুত লিঙ্ক</h3>
          <ul class="list">
            <li><a class="link" href="#" onclick="showMerit('district')">জেলা ভিত্তিক মেধা তালিকা</a></li>
            <li><a class="link" href="#" onclick="showMerit('national')">জাতীয় মেধা তালিকা</a></li>
            <li><a class="link" href="#" onclick="openPdf('sample-admit.pdf')">ফরম/অ্যাডমিট পত্র (ডাউনলোড)</a></li>
            <li><a class="link" href="#" onclick="openPdf('sample-notice.pdf')">নোটিশ</a></li>
          </ul>
          <div style="height:8px"></div>
          <div class="small">আরো তথ্যের জন্য অফিসিয়াল সাইট বা অফিসে যোগাযোগ করুন।</div>
        </div>

        <div style="height:12px"></div>

        <div class="card">
          <h4 style="margin:0 0 8px 0">সাম্পল রোলগুলো (ডেমো)</h4>
          <div class="small">ডেমো খুঁজুন:</div>
          <ul class="list" style="margin-top:8px">
            <li><a href="#" class="link" onclick="fillQuery('roll','100101')">রোল: 100101 — আল আমীন মাদ্রাসা</a></li>
            <li><a href="#" class="link" onclick="fillQuery('roll','100102')">রোল: 100102 — নুরানী মাদ্রাসা</a></li>
            <li><a href="#" class="link" onclick="fillQuery('madrasa','M-202')">মাদরাসা: M-202</a></li>
            <li><a href="#" class="link" onclick="fillQuery('madrasa','M-101')">মাদরাসা: M-101</a></li>
          </ul>
        </div>

        <div style="height:12px"></div>

        <div class="card">
          <h4 style="margin:0 0 8px 0">সাহায্য</h4>
          <div class="small">ফলাফল দেখাতে সমস্যা হলে: <br>ইমেইল: help@haiatul.example<br>ফোন: +8801XXXXXXXXX</div>
        </div>
      </aside>
    </main>

    <footer class="footer">
      © Al-Haiatul Ulya — এই পেজটি একটি ডেমো কপি। বাস্তব সিস্টেমে সার্ভার-সাইড যাচাই ও নিরাপত্তা লাগবে।
    </footer>
  </div>

  <script>
    /***************
     * ডেমো ডেটা
     * বাস্তবে এখানে সার্ভারের API কল করবেন।
     ***************/
    const SAMPLE_DATA = [
      { roll: '100101', reg: 'R-5501', name: 'আল আমীন', madrasa: 'M-101 (আল-আমীন মাদ্রাসা)', board: 'হাইয়াতুল উলয়া', total: '430/550', status:'পাস', details: 'এসএসসি ২০২৪ — জীবনবিজ্ঞান বিভাগ' },
      { roll: '100102', reg: 'R-5502', name: 'মো. নূর', madrasa: 'M-102 (নূরানী মাদ্রাসা)', board: 'হাইয়াতুল উলয়া', total: '482/550', status:'জিপিএ ৪.৬', details: 'এসএসসি ২০২৪ — বিজ্ঞান' },
      { roll: '100201', reg: 'R-5601', name: 'সাবিনা', madrasa: 'M-202 (আলো মাদ্রাসা)', board: 'হাইয়াতুল উলয়া', total: '495/550', status:'জিপিএ ৫.০০', details: 'দাখিল ২০২৪ — বিজ্ঞান' },
      { roll: '100301', reg: 'R-5701', name: 'রফিক', madrasa: 'M-101 (আল-আমীন মাদ্রাসা)', board: 'হাইয়াতুল উলয়া', total: '389/550', status:'ফেইল', details: 'আলিম ২০২৩ — আরবি' }
    ];

    // Pagination সেটিংস (ডেমো)
    const PAGE_SIZE = 5;

    // UI element গুলো
    const searchBy = document.getElementById('searchBy');
    const queryInput = document.getElementById('queryInput');
    const searchBtn = document.getElementById('searchBtn');
    const clearBtn = document.getElementById('clearBtn');
    const resultsTable = document.getElementById('resultsTable');
    const resultsBody = document.getElementById('resultsBody');
    const noResults = document.getElementById('noResults');
    const resultsCount = document.getElementById('resultsCount');
    const pagination = document.getElementById('pagination');

    // খুঁজে দেখার লজিক (স্ট্যাটিক ডেটা ব্যবহার)
    function performSearch(page = 1){
      const by = searchBy.value;
      const q = queryInput.value.trim();
      const exam = document.getElementById('examSelect').value;
      const year = document.getElementById('yearSelect').value;

      // যদি কিউ খালী থাকে তবে সব দেখাব না — ব্যবহারকারীকে অনুরোধ কর
      if (!q) {
        showNoResults('অনুগ্রহ করে রোল/রেজি/মাদরাসা কোড লিখুন।');
        return;
      }

      // ফিল্টার করা (সামান্য ম্যাচিং)
      const filtered = SAMPLE_DATA.filter(item => {
        if (by === 'roll') return item.roll.toLowerCase() === q.toLowerCase();
        if (by === 'reg') return item.reg.toLowerCase() === q.toLowerCase();
        if (by === 'madrasa') return item.madrasa.toLowerCase().includes(q.toLowerCase());
        return false;
      });

      if (filtered.length === 0) {
        showNoResults('কোনো ফলাফল পাওয়া যায়নি। অনুগ্রহ করে ইনপুট যাচাই করুন।');
        return;
      }

      // Pagination (ডেমো_SMALL)
      const total = filtered.length;
      const pages = Math.ceil(total / PAGE_SIZE);
      const start = (page - 1) * PAGE_SIZE;
      const pageItems = filtered.slice(start, start + PAGE_SIZE);

      // টেবিলে রেন্ডার
      resultsBody.innerHTML = '';
      pageItems.forEach(it => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${escapeHtml(it.roll)}</td>
          <td>${escapeHtml(it.name)}</td>
          <td>${escapeHtml(it.madrasa)}</td>
          <td>${escapeHtml(it.board)}</td>
          <td>${escapeHtml(it.total)}</td>
          <td>${escapeHtml(it.status)}</td>
          <td><button class="btn-ghost" onclick="showDetails('${encodeURIComponent(it.roll)}')">বিস্তারিত</button></td>
        `;
        resultsBody.appendChild(tr);
      });

      resultsTable.style.display = '';
      noResults.style.display = 'none';
      resultsCount.textContent = `মোট ${total} রেকর্ড — পেজ ${page} / ${pages}`;

      // Pagination UI
      renderPagination(page, pages);
    }

    function showNoResults(msg){
      resultsTable.style.display = 'none';
      noResults.style.display = '';
      noResults.textContent = msg;
      resultsCount.textContent = '—';
      pagination.innerHTML = '';
    }

    function renderPagination(current, totalPages){
      pagination.innerHTML = '';
      if (totalPages <= 1) return;
      // Prev
      const prev = document.createElement('button');
      prev.textContent = 'পূর্ববর্তী';
      prev.className = 'btn-ghost';
      prev.disabled = current === 1;
      prev.onclick = () => performSearch(current - 1);
      pagination.appendChild(prev);

      // page numbers (সরাসরি সব দেখানো small)
      for (let i=1;i<=totalPages;i++){
        const b = document.createElement('button');
        b.textContent = i;
        b.style.padding = '6px 10px';
        b.style.borderRadius = '6px';
        b.style.border = '1px solid #eef6ff';
        b.style.background = i === current ? '#e8f3ff' : 'transparent';
        b.onclick = () => performSearch(i);
        pagination.appendChild(b);
      }

      // Next
      const next = document.createElement('button');
      next.textContent = 'পরবর্তী';
      next.className = 'btn-ghost';
      next.disabled = current === totalPages;
      next.onclick = () => performSearch(current + 1);
      pagination.appendChild(next);
    }

    // নিরাপদ টেক্সট রেন্ডার
    function escapeHtml(s){
      return String(s).replace(/[&<>"']/g, function(m){ return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[m];});
    }

    // বিস্তারিত দেখানোর ডায়ালগ (সাধারণ)
    function showDetails(encodedRoll){
      const roll = decodeURIComponent(encodedRoll);
      const item = SAMPLE_DATA.find(x => x.roll === roll);
      if (!item) { alert('বিস্তারিত পাওয়া যায়নি'); return; }
      const message = `নাম: ${item.name}\nরোল: ${item.roll}\nরেজি: ${item.reg}\nমাদরাসা: ${item.madrasa}\nপরীক্ষা: ${document.getElementById('examSelect').value.toUpperCase()}\nবিস্তারিত: ${item.details}\nমোট: ${item.total}\nস্ট্যাটাস: ${item.status}`;
      alert(message);
    }

    // UI event handlers
    searchBtn.addEventListener('click', () => performSearch(1));
    clearBtn.addEventListener('click', () => {
      queryInput.value = '';
      showNoResults('অনুসন্ধান পরিষ্কার করা হয়েছে। নতুন কিও লিখুন।');
    });

    // sidebar actions
    function fillQuery(type,value){
      if (type === 'roll') {
        searchBy.value = 'roll';
        queryInput.value = value;
      } else if (type === 'madrasa'){
        searchBy.value = 'madrasa';
        queryInput.value = value;
      }
      // small delay to make UI responsive
      setTimeout(() => performSearch(1), 100);
    }
    window.fillQuery = fillQuery;

    function showMerit(scope){
      if (scope === 'district'){
        alert('ডেমো: জেলা ভিত্তিক মেধা তালিকা খুলুন (এই ফিচনটি বাস্তবে একটি পিডিএফ/পেজ লিংক হবে)।');
      } else {
        alert('ডেমো: জাতীয় মেধা তালিকা দেখুন।');
      }
    }
    window.showMerit = showMerit;

    function openPdf(name){
      alert('ডেমো: "'+name+'" ডাউনলোড বা ওপেন হবে। (এই স্ট্যাটিক ডেমোতে আসলে ফাইল নেই)');
    }
    window.openPdf = openPdf;

    // নিরাপদভাবে global ফাংশন দেখাতে
    window.showDetails = showDetails;

    // ছোট: এক্সেসিবিলিটি/কিবোর্ড রিপন্সিভ — Enter দিলে সার্চ
    queryInput.addEventListener('keydown', function(e){
      if (e.key === 'Enter') {
        e.preventDefault();
        performSearch(1);
      }
    });

    // লোড হলে নোটিশ দেখান
    document.addEventListener('DOMContentLoaded', function(){
      showNoResults('ডেমো: রোল/রেজি/মাদরাসা কোড লিখে অনুসন্ধান করুন। উদাহরণ হিসেবে উপরের সাইডবারে কিছু নমুনা আছে।');
    });
  </script>
</body>
</html>￼Enter            <li><a class="link" href="#" onclick="openPdf('sample-admit.pdf')">ফরম/অ্যাডমিট পত্র (ডাউনলোড)</a></li>
            <li><a class="link" href="#" onclick="openPdf('sample-notice.pdf')">নোটিশ</a></li>
          </ul>
          <div style="height:8px"></div>
          <div class="small">আরো তথ্যের জন্য অফিসিয়াল সাইট বা অফিসে যোগাযোগ করুন।</div>
        </div>

        <div style="height:12px"></div>

        <div class="card">
          <h4 style="margin:0 0 8px 0">সাম্পল রোলগুলো (ডেমো)</h4>
          <div class="small">ডেমো খুঁজুন:</div>
          <ul class="list" style="margin-top:8px">
            <li><a href="#" class="link" onclick="fillQuery('roll','100101')">রোল: 100101 — আল আমীন মাদ্রাসা</a></li>
            <li><a href="#" class="link" onclick="fillQuery('roll','100102')">রোল: 100102 — নুরানী মাদ্রাসা</a></li>
            <li><a href="#" class="link" onclick="fillQuery('madrasa','M-202')">মাদরাসা: M-202</a></li>
            <li><a href="#" class="link" onclick="fillQuery('madrasa','M-101')">মাদরাসা: M-101</a></li>
          </ul>
        </div>

        <div style="height:12px"></div>

        <div class="card">
          <h4 style="margin:0 0 8px 0">সাহায্য</h4>
          <div class="small">ফলাফল দেখাতে সমস্যা হলে: <br>ইমেইল: help@haiatul.example<br>ফোন: +8801XXXXXXXXX</div>
        </div>
      </aside>
    </main>

    <footer class="footer">
      © Al-Haiatul Ulya — এই পেজটি একটি ডেমো কপি। বাস্তব সিস্টেমে সার্ভার-সাইড যাচাই ও নিরাপত্তা লাগবে।
    </footer>
  </div>

  <script>
    /***************
     * ডেমো ডেটা
     * বাস্তবে এখানে সার্ভারের API কল করবেন।
     ***************/
    const SAMPLE_DATA = [
      { roll: '100101', reg: 'R-5501', name: 'আল আমীন', madrasa: 'M-101 (আল-আমীন মাদ্রাসা)', board: 'হাইয়াতুল উলয়া', total: '430/550', status:'পাস', details: 'এসএসসি ২০২৪ — জীবনবিজ্ঞান বিভাগ' },
      { roll: '100102', reg: 'R-5502', name: 'মো. নূর', madrasa: 'M-102 (নূরানী মাদ্রাসা)', board: 'হাইয়াতুল উলয়া', total: '482/550', status:'জিপিএ ৪.৬', details: 'এসএসসি ২০২৪ — বিজ্ঞান' },
      { roll: '100201', reg: 'R-5601', name: 'সাবিনা', madrasa: 'M-202 (আলো মাদ্রাসা)', board: 'হাইয়াতুল উলয়া', total: '495/550', status:'জিপিএ ৫.০০', details: 'দাখিল ২০২৪ — বিজ্ঞান' },
      { roll: '100301', reg: 'R-5701', name: 'রফিক', madrasa: 'M-101 (আল-আমীন মাদ্রাসা)', board: 'হাইয়াতুল উলয়া', total: '389/550', status:'ফেইল', details: 'আলিম ২০২৩ — আরবি' }
    ];

    // Pagination সেটিংস (ডেমো)
    const PAGE_SIZE = 5;

    // UI element গুলো
    const searchBy = document.getElementById('searchBy');
    const queryInput = document.getElementById('queryInput');
    const searchBtn = document.getElementById('searchBtn');
    const clearBtn = document.getElementById('clearBtn');
    const resultsTable = document.getElementById('resultsTable');
    const resultsBody = document.getElementById('resultsBody');
    const noResults = document.getElementById('noResults');
    const resultsCount = document.getElementById('resultsCount');
    const pagination = document.getElementById('pagination');

    // খুঁজে দেখার লজিক (স্ট্যাটিক ডেটা ব্যবহার)
    function performSearch(page = 1){
      const by = searchBy.value;
      const q = queryInput.value.trim();
      const exam = document.getElementById('examSelect').value;
      const year = document.getElementById('yearSelect').value;

      // যদি কিউ খালী থাকে তবে সব দেখাব না — ব্যবহারকারীকে অনুরোধ কর
      if (!q) {
        showNoResults('অনুগ্রহ করে রোল/রেজি/মাদরাসা কোড লিখুন।');
        return;
      }

      // ফিল্টার করা (সামান্য ম্যাচিং)
const filtered = SAMPLE_DATA.filter(item => {
        if (by === 'roll') return item.roll.toLowerCase() === q.toLowerCase();
        if (by === 'reg') return item.reg.toLowerCase() === q.toLowerCase();
        if (by === 'madrasa') return item.madrasa.toLowerCase().includes(q.toLowerCase());
        return false;
      });

      if (filtered.length === 0) {
        showNoResults('কোনো ফলাফল পাওয়া যায়নি। অনুগ্রহ করে ইনপুট যাচাই করুন।');
        return;
      }

      // Pagination (ডেমো_SMALL)
      const total = filtered.length;
      const pages = Math.ceil(total / PAGE_SIZE);
      const start = (page - 1) * PAGE_SIZE;
      const pageItems = filtered.slice(start, start + PAGE_SIZE);

      // টেবিলে রেন্ডার
      resultsBody.innerHTML = '';
      pageItems.forEach(it => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${escapeHtml(it.roll)}</td>
          <td>${escapeHtml(it.name)}</td>
          <td>${escapeHtml(it.madrasa)}</td>
          <td>${escapeHtml(it.board)}</td>
          <td>${escapeHtml(it.total)}</td>
          <td>${escapeHtml(it.status)}</td>
          <td><button class="btn-ghost" onclick="showDetails('${encodeURIComponent(it.roll)}')">বিস্তারিত</button></td>
        `;
        resultsBody.appendChild(tr);
      });

      resultsTable.style.display = '';
      noResults.style.display = 'none';
      resultsCount.textContent = `মোট ${total} রেকর্ড — পেজ ${page} / ${pages}`;

      // Pagination UI
      renderPagination(page, pages);
    }

    function showNoResults(msg){
      resultsTable.style.display = 'none';
      noResults.style.display = '';
      noResults.textContent = msg;
      resultsCount.textContent = '—';
      pagination.innerHTML = '';
    }

    function renderPagination(current, totalPages){
      pagination.innerHTML = '';
      if (totalPages <= 1) return;
      // Prev
      const prev = document.createElement('button');
      prev.textContent = 'পূর্ববর্তী';
      prev.className = 'btn-ghost';
      prev.disabled = current === 1;
      prev.onclick = () => performSearch(current - 1);
      pagination.appendChild(prev);

      // page numbers (সরাসরি সব দেখানো small)
      for (let i=1;i<=totalPages;i++){
        const b = document.createElement('button');
        b.textContent = i;
        b.style.padding = '6px 10px';
        b.style.borderRadius = '6px';
        b.style.border = '1px solid #eef6ff';
        b.style.background = i === current ? '#e8f3ff' : 'transparent';
        b.onclick = () => performSearch(i);
        pagination.appendChild(b);
      }

      // Next

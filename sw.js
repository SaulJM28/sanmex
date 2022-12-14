if (!self.define) {
  let s,
    e = {};
  const t = (t, i) => (
    (t = new URL(t + ".js", i).href),
    e[t] ||
      new Promise((e) => {
        if ("document" in self) {
          const s = document.createElement("script");
          (s.src = t), (s.onload = e), document.head.appendChild(s);
        } else (s = t), importScripts(t), e();
      }).then(() => {
        let s = e[t];
        if (!s) throw new Error(`Module ${t} didn’t register its module`);
        return s;
      })
  );
  self.define = (i, c) => {
    const a =
      s ||
      ("document" in self ? document.currentScript.src : "") ||
      location.href;
    if (e[a]) return;
    let r = {};
    const o = (s) => t(s, a),
      b = { module: { uri: a }, exports: r, require: o };
    e[a] = Promise.all(i.map((s) => b[s] || o(s))).then((s) => (c(...s), r));
  };
}
define(["./workbox-8ec3ac40"], function (s) {
  "use strict";
  self.addEventListener("message", (s) => {
    s.data && "SKIP_WAITING" === s.data.type && self.skipWaiting();
  }),
    s.precacheAndRoute(
      [
        { url: "index.html", revision: "d982d7beafef8d6854659430e7de0361" },
        { url: "manifest.json", revision: "2c5330969b0eba0dfb0ea859dad7f366" },
        {
          url: "static/css/bootstrap-grid.css",
          revision: "02c04dfa80af659dc6f4c517b677435d",
        },
        {
          url: "static/css/bootstrap-grid.min.css",
          revision: "dbd47382523d754013115de4be202a74",
        },
        {
          url: "static/css/bootstrap-grid.rtl.css",
          revision: "63d1e5a2903e394f52b1fccaf84159a0",
        },
        {
          url: "static/css/bootstrap-grid.rtl.min.css",
          revision: "92871a500cb2d82f99258a6a17e46ef6",
        },
        {
          url: "static/css/bootstrap-reboot.css",
          revision: "28372dcca49ddee994668db39a49f7f0",
        },
        {
          url: "static/css/bootstrap-reboot.min.css",
          revision: "7b3e39ea9e950f59c494f3e0ae5971db",
        },
        {
          url: "static/css/bootstrap-reboot.rtl.css",
          revision: "d7cfce563ed23132808a3647f675a1ae",
        },
        {
          url: "static/css/bootstrap-reboot.rtl.min.css",
          revision: "1a3cae87f043a9031675fab697888c7c",
        },
        {
          url: "static/css/bootstrap-utilities.css",
          revision: "a5f78ee119a023227eceb749f83f6b12",
        },
        {
          url: "static/css/bootstrap-utilities.min.css",
          revision: "5e47a49091ab986da0c9a5122a5dfe6c",
        },
        {
          url: "static/css/bootstrap-utilities.rtl.css",
          revision: "a3ff7a01905bed4e279995549711d424",
        },
        {
          url: "static/css/bootstrap-utilities.rtl.min.css",
          revision: "1200ba112673d97391e77f097d1eb26f",
        },
        {
          url: "static/css/bootstrap.css",
          revision: "41ba0ff5eed842d853aede220a3ccfee",
        },
        {
          url: "static/css/bootstrap.min.css",
          revision: "3f30c2c47d7d23c7a994db0c862d45a5",
        },
        {
          url: "static/css/bootstrap.rtl.css",
          revision: "1457707e717950e48e9af2ef614b68e8",
        },
        {
          url: "static/css/bootstrap.rtl.min.css",
          revision: "dfa5ca983e2834131c9d9d51ae3b1eb2",
        },
        {
          url: "static/img/icons/icon-192x192.png",
          revision: "45136266b777abb7df690e0bfbf92f7f",
        },
        {
          url: "static/img/icons/icon-256x256.png",
          revision: "b539ae996d2a86eb0efae723589bdb25",
        },
        {
          url: "static/img/icons/icon-384x384.png",
          revision: "d430fe284e470ab094e5474813030b13",
        },
        {
          url: "static/img/icons/icon-512x512.png",
          revision: "f9669ec7adb00929da46d79f75f1b2fd",
        },
        {
          url: "static/js/bootstrap.bundle.js",
          revision: "01a034c34cb9c1d2f062af8def13ecb7",
        },
        {
          url: "static/js/bootstrap.bundle.min.js",
          revision: "b75ae000439862b6a97d2129c85680e8",
        },
        {
          url: "static/js/bootstrap.esm.js",
          revision: "f86c449a0babc30b33ff71a6fd064833",
        },
        {
          url: "static/js/bootstrap.esm.min.js",
          revision: "da74cf4659eb6c671e549aaed3d7ca1d",
        },
        {
          url: "static/js/bootstrap.js",
          revision: "1376378024397729b1febb40f5a0e16f",
        },
        {
          url: "static/js/bootstrap.min.js",
          revision: "b0794583ec020a7852f0fc04d5cefc52",
        },
      ],
      { ignoreURLParametersMatching: [/^utm_/, /^fbclid$/] }
    );
});
//# sourceMappingURL=sw.js.map

/**
 * Template Name: NiceAdmin
 * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
 * Updated: Apr 20 2024 with Bootstrap v5.3.3
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */

(function () {
  ("use strict");

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim();
    if (all) {
      return [...document.querySelectorAll(el)];
    } else {
      return document.querySelector(el);
    }
  };

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach((e) => e.addEventListener(type, listener));
    } else {
      select(el, all).addEventListener(type, listener);
    }
  };

  /**
   * Easy on scroll event listener
   */
  const onscroll = (el, listener) => {
    el.addEventListener("scroll", listener);
  };

  /**
   * Sidebar toggle
   */
  if (select(".toggle-sidebar-btn")) {
    on("click", ".toggle-sidebar-btn", function (e) {
      select("body").classList.toggle("toggle-sidebar");
    });
  }

  /**
   * Search bar toggle
   */
  if (select(".search-bar-toggle")) {
    on("click", ".search-bar-toggle", function (e) {
      select(".search-bar").classList.toggle("search-bar-show");
    });
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select("#navbar .scrollto", true);
  const navbarlinksActive = () => {
    let position = window.scrollY + 200;
    navbarlinks.forEach((navbarlink) => {
      if (!navbarlink.hash) return;
      let section = select(navbarlink.hash);
      if (!section) return;
      if (
        position >= section.offsetTop &&
        position <= section.offsetTop + section.offsetHeight
      ) {
        navbarlink.classList.add("active");
      } else {
        navbarlink.classList.remove("active");
      }
    });
  };
  window.addEventListener("load", navbarlinksActive);
  onscroll(document, navbarlinksActive);

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select("#header");
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add("header-scrolled");
      } else {
        selectHeader.classList.remove("header-scrolled");
      }
    };
    window.addEventListener("load", headerScrolled);
    onscroll(document, headerScrolled);
  }

  /**
   * Back to top button
   */
  let backtotop = select(".back-to-top");
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add("active");
      } else {
        backtotop.classList.remove("active");
      }
    };
    window.addEventListener("load", toggleBacktotop);
    onscroll(document, toggleBacktotop);
  }

  /**
   * Initiate tooltips
   */
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  /**
   * Initiate quill editors
   */
  if (select(".quill-editor-default")) {
    new Quill(".quill-editor-default", {
      theme: "snow",
    });
  }

  if (select(".quill-editor-bubble")) {
    new Quill(".quill-editor-bubble", {
      theme: "bubble",
    });
  }

  if (select(".quill-editor-full")) {
    new Quill(".quill-editor-full", {
      modules: {
        toolbar: [
          [
            {
              font: [],
            },
            {
              size: [],
            },
          ],
          ["bold", "italic", "underline", "strike"],
          [
            {
              color: [],
            },
            {
              background: [],
            },
          ],
          [
            {
              script: "super",
            },
            {
              script: "sub",
            },
          ],
          [
            {
              list: "ordered",
            },
            {
              list: "bullet",
            },
            {
              indent: "-1",
            },
            {
              indent: "+1",
            },
          ],
          [
            "direction",
            {
              align: [],
            },
          ],
          ["link", "image", "video"],
          ["clean"],
        ],
      },
      theme: "snow",
    });
  }

  /**
   * Initiate TinyMCE Editor
   */

  const useDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches;
  const isSmallScreen = window.matchMedia("(max-width: 1023.5px)").matches;

  tinymce.init({
    selector: "textarea.tinymce-editor",
    plugins:
      "preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion",
    editimage_cors_hosts: ["picsum.photos"],
    menubar: "file edit view insert format tools table help",
    toolbar:
      "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    link_list: [
      {
        title: "My page 1",
        value: "https://www.tiny.cloud",
      },
      {
        title: "My page 2",
        value: "http://www.moxiecode.com",
      },
    ],
    image_list: [
      {
        title: "My page 1",
        value: "https://www.tiny.cloud",
      },
      {
        title: "My page 2",
        value: "http://www.moxiecode.com",
      },
    ],
    image_class_list: [
      {
        title: "None",
        value: "",
      },
      {
        title: "Some class",
        value: "class-name",
      },
    ],
    importcss_append: true,
    file_picker_callback: (callback, value, meta) => {
      /* Provide file and text for the link dialog */
      if (meta.filetype === "file") {
        callback("https://www.google.com/logos/google.jpg", {
          text: "My text",
        });
      }

      /* Provide image and alt text for the image dialog */
      if (meta.filetype === "image") {
        callback("https://www.google.com/logos/google.jpg", {
          alt: "My alt text",
        });
      }

      /* Provide alternative source and posted for the media dialog */
      if (meta.filetype === "media") {
        callback("movie.mp4", {
          source2: "alt.ogg",
          poster: "https://www.google.com/logos/google.jpg",
        });
      }
    },
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar:
      "bold italic | quicklink h2 h3 blockquote quickimage quicktable",
    noneditable_class: "mceNonEditable",
    toolbar_mode: "sliding",
    contextmenu: "link image table",
    skin: useDarkMode ? "oxide-dark" : "oxide",
    content_css: useDarkMode ? "dark" : "default",
    content_style:
      "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
  });

  /**
   * Initiate Bootstrap validation check
   */
  var needsValidation = document.querySelectorAll(".needs-validation");

  Array.prototype.slice.call(needsValidation).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });

  /**
   * Initiate Datatables
   */
  const datatables = select(".datatable", true);
  datatables.forEach((datatable) => {
    new simpleDatatables.DataTable(datatable, {
      perPageSelect: [5, 10, 15, ["All", -1]],
      columns: [
        {
          select: 2,
          sortSequence: ["desc", "asc"],
        },
        {
          select: 3,
          sortSequence: ["desc"],
        },
        {
          select: 4,
          cellClass: "green",
          headerClass: "red",
        },
      ],
    });
  });

  /**
   * Autoresize echart charts
   */
  const mainContainer = select("#main");
  if (mainContainer) {
    setTimeout(() => {
      new ResizeObserver(function () {
        select(".echart", true).forEach((getEchart) => {
          const chart = echarts.getInstanceByDom(getEchart);
          if (chart) {
            // ✅ Check if chart exists
            chart.resize();
          }
        });
      }).observe(mainContainer);
    }, 200);
  }

  /**
   *
   *
   *
   *
   *  Manually by added prancisss
   *
   *
   *
   *
   */
  // Edit Transaction
  document.addEventListener("DOMContentLoaded", () => {
    // Get all rows with the class "transaction-row"
    const rows = document.querySelectorAll(".transaction-row");

    rows.forEach((row) => {
      row.addEventListener("click", () => {
        // Get the transaction ID from the row's data-id attribute
        const transactionId = row.getAttribute("data-id");
        console.log("Transaction ID:", transactionId);

        // Open the edit modal and populate data
        openEditModal(transactionId);
      });
    });

    // Function to open the Edit Modal
    function openEditModal(transactionId) {
      // Example: Fetch transaction data from backend using transactionId
      fetch(
        `../controller/transactionUpdate&DeleteRecord.php?id=${transactionId}`
      )
        .then((response) => response.json())
        .then((data) => {
          // Populate the modal fields
          document.getElementById("editInputNumber").value = data.amount;
          document.getElementById("editCategory").value = data.category;
          document.getElementById("editTransaction").value = data.transaction; // Make sure the ID matches
          document.getElementById("editInputDate").value =
            data.date.split(" ")[0]; // Extract date part only
          document.getElementById("editAccount").value = data.payment_type; // Make sure 'editAccount' matches the select ID
          document.getElementById("editDescription").value = data.description;
          document.getElementById("editTransactionId").value =
            data.transaction_id; // For tracking the ID

          // Show the modal
          const modal = new bootstrap.Modal(
            document.getElementById("editRecordModal")
          );
          modal.show();
        })
        .catch((error) =>
          console.error("Error loading transaction data:", error)
        );
    }
  });
  // when user hit the submit button
  document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("editRecordForm");

    if (form) {
      form.addEventListener("submit", (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);

        fetch("../controller/transactionUpdate&DeleteRecord.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              location.reload(); // Reload table to reflect changes
            } else {
              console.error("Failed to update record:", data.error);
            }
          })
          .catch((error) => console.error("Error updating record:", error));
      });
    } else {
      console.error("Form with ID 'editRecordForm' not found!");
    }
  });

  // ✅ Handle delete submission
  document.addEventListener("DOMContentLoaded", () => {
    const deleteTransactionBtn = document.getElementById(
      "deleteTransactionBtn"
    );

    if (deleteTransactionBtn) {
      deleteTransactionBtn.addEventListener("click", () => {
        const transactionId =
          document.getElementById("editTransactionId").value;

        if (
          transactionId &&
          confirm("Are you sure you want to delete this record?")
        ) {
          fetch("../controller/transactionUpdate&DeleteRecord.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `delete=true&transaction_id=${encodeURIComponent(
              transactionId
            )}`,
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.success) {
                console.log("Record deleted successfully");
                location.reload(); // ✅ Reload table after deletion
              } else {
                console.error("Failed to delete record:", data.error);
              }
            })
            .catch(async (error) => {
              const responseText = await error.response?.text();
              console.error("Error deleting record:", responseText || error);
            });
        }
      });
    }
  });
  // if the balance go under 0 places another text
  document.addEventListener("DOMContentLoaded", () => {
    // Get balance value from the HTML
    const balance = parseFloat(
      document.getElementById("currentBalance").innerText.replace(/[₱,]/g, "")
    );

    const balanceStatus = document.getElementById("balanceStatus");

    if (balance < 0) {
      balanceStatus.classList.remove("text-success", "text-warning");
      balanceStatus.classList.add("text-danger"); // Change color to red if negative
      balanceStatus.innerText = "You are now in debt";
    } else if (balance === 0) {
      balanceStatus.classList.remove("text-success", "text-danger");
      balanceStatus.classList.add("text-warning"); // Change color to orange if zero
      balanceStatus.innerText = "Broke as fuck";
    } else {
      balanceStatus.classList.remove("text-danger", "text-warning");
      balanceStatus.classList.add("text-success"); // Change color to green if positive
      balanceStatus.innerText = "Debt free sheesh";
    }
  });

  // edit tasks reminder
  const editTaskModal = document.getElementById("editTaskModal");
  editTaskModal.addEventListener("show.bs.modal", (event) => {
    const button = event.relatedTarget; // Button that triggered the modal

    // Extract data from data-* attributes
    const task_description = button.getAttribute("data-description");
    const id = button.getAttribute("data-id");
    const title = button.getAttribute("data-title");
    const date = button.getAttribute("data-date");

    console.log(description);

    // Fill the form fields
    document.getElementById("editTaskDescription").value = task_description;
    document.getElementById("editTaskId").value = id;
    document.getElementById("editTitle").value = title;
    document.getElementById("editDate").value = date;
  });
})();

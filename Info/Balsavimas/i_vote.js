$(document).ready(function () {
  function updateVotes() {
    $.ajax({
      url: "update_main_vote.php",
      method: "GET",
      success: function (json_response) {
        var data = JSON.parse(json_response);
        console.log("Data received from server:", data);
        var voteSection = $("#view-main-vote");
        voteSection.empty(); 
        if (data.votes.length > 0) {
          // Log the overall vote counts
          var voteTypes = data.vote_types.reduce((acc, curr) => {
            acc[curr.vote_type] = curr.vote_count;
            return acc;
          }, {});
          var yesCount = parseInt(voteTypes['yes']);
          var noCount = parseInt(voteTypes['no']);
          console.log("Overall Yes vote count:", yesCount);
          console.log("Overall No vote count:", noCount);
          
          // Define HTML template
          var htmlTemplate = `
            <div class="voter-entry">
              <h1 class="voter-entry-title">Balsavimas: {suggestion}</h1>
              <h3 class="voter-entry-name">Balsavimo autorius: {usname}</h3>
              <div class="voter-entry-buttons">
                <button class="vote-button" data-id="{id}" data-vote="yes">Pritariu</button>
                <button class="vote-button" data-id="{id}" data-vote="no">Nepritariu</button>
              </div>
            </div>
            <div class="vote-bars" id="vote-bars-{id}">
              <div class="yes-bar"></div>
              <div class="no-bar"></div>
            </div>
          `;
          
          data.votes.forEach(function(item) {
            // Fill HTML template with item data
            var filledHtml = htmlTemplate
              .replace(/{suggestion}/g, item.suggestion)
              .replace(/{usname}/g, item.usname)
              .replace(/{id}/g, item.id);
            
            voteSection.append(filledHtml);
            
            const yesCountItem = parseInt(voteTypes['yes']);
            const noCountItem = parseInt(voteTypes['no']);
            const totalVotesItem = yesCountItem + noCountItem;
            const yesPercentage = Math.round((yesCountItem / totalVotesItem) * 100);
            const noPercentage = Math.round((noCountItem / totalVotesItem) * 100);

            console.log(`Yes bar width: ${yesPercentage}%`);
            console.log(`No bar width: ${noPercentage}%`);
          });
        
          // Attach event listeners to vote buttons
          $(".vote-button").off("click").on("click", function() {
            var suggestionId = $(this).data("id");
            var voteType = $(this).data("vote");
            castVote(suggestionId, voteType);
          });
        } else {
          voteSection.html('<p>No votes found.</p>');
        }
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      }
    });
  }

  // Function to cast a vote
  function castVote(suggestionId, voteType) {
    $.ajax({
      url: "update_main_vote.php",
      method: "POST",
      data: { suggestionId: suggestionId, voteType: voteType },
      success: function(response) {
        // Handle success response
        // For example, you can update the UI to reflect the new vote count
        updateVotes();
      },
      error: function(xhr, status, error) {
        console.error("Error:", error);
      }
    });
  }

  // Call updateVotes function initially
  updateVotes();
  setInterval(updateVotes, 50000);
});













//// Function update_vote.php container C witg AJAX
$(document).ready(function () {
  function updateVotes() {
    $.ajax({
      url: "update_vote.php",
      method: "GET",
      success: function (response) {
        $("#view-it").html(response)
      },
      error: function (xhr, status, error) {
        console.error("Error:", error)
      }
    })
  }

  updateVotes()
  // laikas 5sec = 5000
  setInterval(updateVotes, 50000)
})

//// ToolTip
document.addEventListener("DOMContentLoaded", function () {
  const labelBlocks = document.querySelectorAll(".form-block")

  labelBlocks.forEach(function (labelBlock) {
    const label = labelBlock.querySelector("label")
    const tooltipText = labelBlock.getAttribute("data-tooltip")

    label.addEventListener("mouseenter", function () {
      showTooltip(label, tooltipText)
    })

    label.addEventListener("mouseleave", function () {
      hideTooltip()
    })
  })

  function showTooltip(label, text) {
    const tooltip = document.createElement("div")
    tooltip.classList.add("tooltip")
    tooltip.innerHTML = text
    document.body.appendChild(tooltip)

    const labelRect = label.getBoundingClientRect()
    const tooltipRect = tooltip.getBoundingClientRect()

    tooltip.style.top = labelRect.top - tooltipRect.height - 10 + "px"
    tooltip.style.left = labelRect.left + (labelRect.width - tooltipRect.width) / 2 + "px"
  }

  function hideTooltip() {
    const tooltip = document.querySelector(".tooltip")
    if (tooltip) {
      tooltip.parentNode.removeChild(tooltip)
    }
  }
})

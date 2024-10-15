import axios from "axios";
import moment from "moment";

document.addEventListener("DOMContentLoaded", () => {
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);
    const $form = $("#form-search-person");

    $form?.addEventListener("submit", async (e) => {
        e.preventDefault();
        const $rowTemplate = $("#assist_event_row");
        const $tbody = $("#assist_events");
        const formData = new FormData(e.target);
        const $inputDni = $form.querySelector("#dni");

        $inputDni.disabled = true;

        try {
            const { data } = await axios.post("/api/events/assists", formData);

            const $row = $rowTemplate.content.cloneNode(true);
            const $tds = $row.querySelectorAll("p");

            $tds[0].textContent =
                data.first_surname +
                " " +
                data.second_surname +
                ", " +
                data.first_name;
            $tds[1].textContent = data.email;
            $tds[2].textContent = data.career;
            $tds[3].textContent = data.period;
            $tds[4].textContent = data.institution;
            $tds[5].textContent = data.event.name;
            $tds[6].textContent = moment(data.created_at).format(
                "DD/MM/YYYY HH:mm"
            );
            $tbody.prepend($row);

            const mp3 = new Audio("/notify.mp3");
            mp3.play();
        } catch (error) {
            const content =
                typeof error.response.data === "object"
                    ? error.response.data.message
                    : error.response.data;
            alert(content);
        } finally {
            $inputDni.value = "";
            $inputDni.disabled = false;
            $inputDni.focus();
        }
    });
});
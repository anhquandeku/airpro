const dataTable = (ma, ho_ten, email, className) => {
  return `<tr class="${className}">
    <td>${ma}</td>
    <td>${ho_ten}</td>
    <td>${email}</td>
    <td class="col-action">
        <button type="button" class="btn btn-sm btn-success btn-col">
          <i class="bi bi-card-heading"></i>
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-col">
        <i class="bi bi-person-fill-lock"></i>
      </button>
    </td>
  </tr>`;
};

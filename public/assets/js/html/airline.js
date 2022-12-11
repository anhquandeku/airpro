const tableAirline = (className, id, name, discribe) => {
  return `<tr class="${className}">
    <td class="list-checkbox">
      <div class="custom-control custom-checkbox">
        <input
          type="checkbox"
          class="form-check-input form-check-success form-check-glow" onChange = "handleCheck(event)"
          id="${id}"
        />
      </div>
    </td> 
    <td>${id}</td>
    <td>${name}</td>
    <td class="row-longtext" style="width: 5rem; text-overflow: ellipsis; white-space: nowrap; overflow: hidden">${discribe}</td>
    <td class="col-action">
      <button
        onclick="handleView('${id}')"
        type="button"
        class="btn btn-sm btn-outline-primary"
        style="padding-top: 3px; padding-bottom: 4px;"
      >
        <i class="bi bi-eye"></i>
      </button>
      <button
        onclick="handleEdit('${id}')"
        type="button"
        class="btn btn-sm btn-outline-success"
        style="padding-top: 7px; padding-bottom: 0px;"
      >
        <i class="bi bi-tools"></i>
      </button>
      <button
        onclick="deleteRow('${id}')"
        type="button"
        class="btn btn-sm btn-outline-danger"
        style="padding-top: 7px; padding-bottom: 0px;"
      >
        <i class="bi bi-trash-fill"></i>
      </button>
    </td>
  </tr>`;
};

const rule_airline = {
  mahanghangkhong: {
    required: true,
  },
  tenhanghangkhong: {
    required: true,
  },
  motahanghangkhong: {
    required: true,
  },
  loaihanghangkhong: {
    required: true,
  },
};
const message_airline = {
  mahanghangkhong: {
    required: "Vui lòng nhập mã hãng hàng không",
  },
  tenhanghangkhong: {
    required: "Vui lòng nhập tên hãng hàng không",
  },
  motahanghangkhong: {
    required: "Vui lòng nhập mô tả hãng hàng không",
  },
  loaihanghangkhong: {
    required: "Vui lòng nhập loại hãng hàng không",
  },
};

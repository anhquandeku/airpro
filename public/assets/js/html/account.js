const dataTable = (ma, ho_ten, email, className, status) => {
  let lock = status
    ? '  <i class="bi bi-person-fill-lock"></i>'
    : ' <i class="bi bi-unlock-fill"></i>';
  let classLock = status ? "" : "lock-info";
  return `<tr class="${className}">
    <td class="${classLock}">${ma}</td>
    <td class="${classLock}">${ho_ten}</td>
    <td class="${classLock}">${email}</td>
    <td class="col-action">
        <button type="button" class="btn btn-sm btn-success btn-col" onclick="viewRow('${ho_ten}')">
          <i class="bi bi-card-heading"></i>
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-col" onclick="lockAccount('${ho_ten}',${status})">
        ${lock}
      </button>
    </td>
  </tr>`;
};

const addTableCustomer = (data, className) => {
  return `<tr class="${className}">
    <td>${data.ma_kh}</td>
    <td>${data.ho_ten}</td>
    <td>${data.email}</td>
    <td class="col-action">
        <button type="button" class="btn btn-sm btn-success btn-col" onclick="createAccount('${data.ma_kh}','${data.ho_ten}', '${data.email}')">
        <i class="bi bi-person-fill-add"></i>
        </button>
    </td>
  </tr>`;
};

const addTableStaff = (data, className) => {
  return `<tr class="${className}">
  <td>${data.ma_nv}</td>
  <td>${data.ho_ten}</td>
  <td>${data.email}</td>
  <td class="col-action">
      <button type="button" class="btn btn-sm btn-success btn-col" onclick="createAccount('${data.ma_nv}','${data.ho_ten}', '${data.email}')">
      <i class="bi bi-person-fill-add"></i>
      </button>
  </td>
</tr>`;
};

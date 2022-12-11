const dataTable = (className, data) => {
  return `<tr class="${className}">
   <td class="list-checkbox">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="${data.ma_kh}" onChange = "handleCheck(event)">
        </div>
    </td>
    <td>${data.ho_ten}</td>
    <td>${data.ten_hang}</td>
    <td>${data.sdt}</td>
   <td>${data.cccd}</td>
    <td>
        <button onclick="handleView('${data.ma_kh}')" type="button" class="btn btn-sm btn-outline-primary" style="padding-top: 3px; padding-bottom: 4px;">
           <i class="bi bi-eye"></i>
     </button>
        <button onclick="handleEdit('${data.ma_kh}')" type="button" class="btn btn-sm btn-outline-success" style="padding-top: 7px; padding-bottom: 0px;">
          <i class="bi bi-tools"></i>
        </button>
       <button onclick="handleDeleteOne('${data.ma_kh}')" type="button" class="btn btn-sm btn-outline-danger" style="padding-top: 7px; padding-bottom: 0px;">
           <i class="bi bi-trash-fill"></i>
        </button>
    </td>
</tr>`;
};
const rule_customer = {
  fullnamekh: {
    required: true,
    validateName: true,
  },

  cccdkh: {
    required: true,
    number: true,
  },
  numberphonekh: {
    required: true,
    number: true,
  },
  emailkh: {
    required: true,
    email: true,
  },
  birthdaykh: {
    required: true,
  },
  genderkh: {
    required: true,
  },
  addresskh: {
    required: true,
  },
};
const message_customer = {
  fullnamekh: {
    required: "Vui lòng nhập họ tên",
  },
  cccdkh: {
    required: "Vui lòng nhập căn cước công dân",
    number: "Căn cước công dân phải là số",
  },
  numberphonekh: {
    required: "Vui lòng nhập số điện thoại",
    number: "Số điện thoại dân phải là số",
  },
  emailkh: {
    required: "Vui lòng nhập email",
    email: "Vui lòng nhập đúng định dạng email",
  },
  birthdaykh: {
    required: "Vui lòng nhập ngày sinh",
  },
  addresskh: {
    required: "Vui lòng nhập địa chỉ",
  },
};

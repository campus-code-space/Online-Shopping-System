
let userdata = JSON.parse(localStorage.getItem('userdata'));

export const getUserRole = ()=>{
    let role = null;
    return (userdata['role'])?userdata['role']:role;
}

export const getUserToken = ()=>{
    let token = null;
    return (userdata['token'])?userdata['token']:token;
}

// module.exports = {getUserRole,getUserToken};
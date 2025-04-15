import React from 'react'
import { getUserRole } from './auth';
import { Navigate } from 'react-router-dom';
function PrivateRoute({Component,allowedRoles}) {

    const userrole = getUserRole();
    
    if(allowedRoles.includes(userrole)){
      return <Component/>
      }else{
        
      return <Navigate to='/unauthorized' replace/>
    }
  
}

export default PrivateRoute
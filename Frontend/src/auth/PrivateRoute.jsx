import React from 'react'
import { getUserRole } from './auth';
import { Redirect, Route } from 'react-router-dom';
function PrivateRoute({element:Component,allowedRoles,...rest}) {

    const userrole = getUserRole();
    
  return (
    <Route
        {...rest}
        render={(props)=>
                (allowedRoles.includes(userrole))?<Component {...props}/>:<Redirect to='/unauthorized'/>
        }
    />
  )
}

export default PrivateRoute
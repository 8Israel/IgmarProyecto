import { HttpInterceptorFn } from '@angular/common/http';
import { LoginService } from '../services/login.service';

export const tokenInterceptor: HttpInterceptorFn = (req, next) => {

  let token: string|null = localStorage.getItem('token');

  let headers = req.headers

  if(token){
    headers = headers.set('Authorization', 'Bearer' + token)
<<<<<<< HEAD
    
=======
    // LoginService.getInstance().setToken(token);
>>>>>>> 2d6ce7c60ff1997370466c3e7852a155a617d6a6
  }

  headers = headers.set('Accept', 'application/json')

  req = req.clone({headers: headers})

  return next(req);
};

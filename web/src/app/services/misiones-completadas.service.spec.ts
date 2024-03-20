import { TestBed } from '@angular/core/testing';

import { MisionesCompletadasService } from './misiones-completadas.service';

describe('MisionesCompletadasService', () => {
  let service: MisionesCompletadasService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(MisionesCompletadasService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});

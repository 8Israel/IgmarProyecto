import { TestBed } from '@angular/core/testing';

import { ClanesService } from './clanes.service';

describe('ClanesService', () => {
  let service: ClanesService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ClanesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});

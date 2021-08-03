interface InterestType {
  id: number,
  title: string,
  type: string,
}

export interface ProfileType {
  id: number,
  name: string,
  age: number,
  status: string,
  photos: string[],
  about: string,
  interests: InterestType[],
}

export class Profile implements ProfileType {
  constructor(
    public readonly id: number,
    public readonly name: string,
    public readonly age = 50,
    public readonly status = 'test',
    public readonly photos: string[] = [],
    public readonly about: string,
    public readonly interests: InterestType[],
  ) {
  }
}

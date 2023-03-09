import { useQuery } from '@tanstack/react-query';
import { getUser } from '../services/UserApi';
import Card from './UI/Card';

const Profile = (props: { userId: number }) => {
  const userId = props.userId;
  const {
    isLoading,
    error,
    data: userData,
  } = useQuery({
    queryKey: [`user`],
    queryFn: () => getUser(userId),
  });

  if (isLoading) return <div>Loading...</div>;

  if (error) return <div>An error has occurred.</div>;

  if (userData) {
    const {
      firstName,
      lastName,
      email,
      password,
      backgroundColor,
      foregroundColor,
    } = userData;
    return (
      <Card>
        <div>{firstName}</div>
        <div>{lastName}</div>
        <div>{email}</div>
        <div>{password}</div>
        <div>{backgroundColor}</div>
        <div>{foregroundColor}</div>
      </Card>
    );
  }
};

export default Profile;
